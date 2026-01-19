<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['items.book'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('order.index', compact('orders'));
    }
}
