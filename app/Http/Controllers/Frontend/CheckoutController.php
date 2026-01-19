<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function index()
    {
        // For simplicity, we get all items from the cart.
        // ideally we should process only "selected" items.
        // For now, let's assume all cart items are checking out.

        $cart = Cart::with(['items.book'])->where('user_id', Auth::id())->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty');
        }

        $items = $cart->items;
        $subtotal = $items->sum(fn($item) => $item->book->final_price * $item->qty);
        // Add simple tax or fee logic here if needed
        $total = $subtotal;

        return view('checkout.index', compact('items', 'subtotal', 'total', 'cart'));
    }

    public function process(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::with(['items.book'])->where('user_id', $user->id)->first();

        if (!$cart || $cart->items->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'Cart empty']);
        }

        DB::beginTransaction();
        try {
            // 1. Create Order
            $order = Order::create([
                'user_id' => $user->id,
                'number' => 'ORD-' . time() . '-' . rand(100, 999),
                'total_price' => 0, // calc below
                'payment_status' => 'pending', // Pending
            ]);

            $totalPrice = 0;
            $itemsDetails = [];

            // 2. Create Order Items
            foreach ($cart->items as $item) {
                $price = (int) $item->book->final_price;
                $sub = $price * $item->qty;
                $totalPrice += $sub;

                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $item->book_id,
                    'qty' => $item->qty,
                    'price' => $price,
                ]);

                $itemsDetails[] = [
                    'id' => $item->book_id,
                    'price' => $price,
                    'quantity' => $item->qty,
                    'name' => substr($item->book->title, 0, 50),
                ];
            }

            $order->update(['total_price' => $totalPrice]);

            // 3. Midtrans Params
            $params = [
                'transaction_details' => [
                    'order_id' => $order->number,
                    'gross_amount' => $totalPrice, // Must match sum of items
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                ],
                'item_details' => $itemsDetails,
            ];

            Log::info('Midtrans Params:', $params);

            $snapToken = Snap::getSnapToken($params);

            $order->update(['snap_token' => $snapToken]);

            // 4. Clear Cart (Optional: clear only after payment success? or clear now?)
            // Usually we clear cart after order created to prevent double order.
            $cart->items()->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'snap_token' => $snapToken,
                'order_id' => $order->number
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
