<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function payment(Order $order) {
        Cart::destroy();
        $items = json_decode($order->content);
        return view('orders.payment', compact('order', 'items'));
    }

    public function show(Order $order) {
        return view('orders.show', compact('order'));
    }

    public function pay(Order $order, Request $request) {
        $payment_id = $request->get('payment_id');
        $token = config('services.mercadopago.token');
        $response = json_decode(Http::get("https://api.mercadopago.com/v1/payments/$payment_id"."?access_token=$token"));
        $status = $response->status;
        if ($status === "approved") {
            $order->status = 2;
            $order->save();
        }
        return redirect()->route('orders.show', $order);
    }
}
