<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index() {
        $order_status = request('status');
        $orders_query = Order::query()->has('user');
        if ($order_status)
            $orders_query->where('status', $order_status);
        $orders = $orders_query->paginate(5);
        $total_orders = Order::query()->has('user')->get();
        return view('orders.index', compact('orders', 'total_orders'));
    }

    public function payment(Order $order) {
        Cart::destroy();
        $items = json_decode($order->content);
        return view('orders.payment', compact('order', 'items'));
    }

    public function show(Order $order) {
        $this->authorize('author', $order);
        $items = json_decode($order->content);
        return view('orders.show', compact('order', 'items'));
    }

    public function pay(Order $order, Request $request) {
        $this->authorize('author', $order);
        $this->authorize('payment', $order);
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
