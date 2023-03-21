<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;   

class OrderController extends Controller
{
    public function index() {
        $orders = Order::whereUser_id(auth()->user()->id)->orderBy('created_at', 'desc')
            ->paginate(5);
        $statuses = Order::STATUSES;
        return view('user.order.index',compact('orders','statuses'));
    }
    
    public function show(Order $order) {
        if (auth()->user()->id !== $order->user_id) {
            // можно просматривать только свои заказы
            abort(404);
        }
        $statuses = Order::STATUSES;
        return view('user.order.show',compact('order','statuses'));
    }
}
