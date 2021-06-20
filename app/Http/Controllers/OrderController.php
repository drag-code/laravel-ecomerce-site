<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function payment(Order $order) {
        Cart::destroy();
        $items = json_decode($order->content);
        return view('orders.payment', compact('order', 'items'));
    }
}
