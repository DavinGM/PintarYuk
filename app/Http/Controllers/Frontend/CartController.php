<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Display Cart Page
    public function index()
    {
        $cart = Cart::with(['items.book'])->where('user_id', Auth::id())->first();

        return view('cart.index', compact('cart'));
    }

    // Add to Cart Logic
    public function addToCart(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'qty' => 'nullable|integer|min:1'
        ]);

        $user = Auth::user();
        $qty = $request->qty ?? 1;

        // Get or Create Cart
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        // Check if item exists
        $item = $cart->items()->where('book_id', $request->book_id)->first();

        if ($item) {
            $item->increment('qty', $qty);
        } else {
            $cart->items()->create([
                'book_id' => $request->book_id,
                'qty' => $qty
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Added to cart',
            'cart_count' => $cart->items()->sum('qty')
        ]);
    }

    // Update Quantity (AJAX)
    public function updateQty(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:cart_items,id',
            'qty' => 'required|integer|min:1'
        ]);

        $item = CartItem::where('id', $request->item_id)
            ->whereHas('cart', function ($q) {
                $q->where('user_id', Auth::id());
            })->firstOrFail();

        $item->update(['qty' => $request->qty]);

        return response()->json(['status' => 'success']);
    }

    // Remove Item
    public function destroy($id)
    {
        $item = CartItem::where('id', $id)
            ->whereHas('cart', function ($q) {
                $q->where('user_id', Auth::id());
            })->firstOrFail();

        $item->delete();

        return response()->json(['status' => 'success']);
    }
}
