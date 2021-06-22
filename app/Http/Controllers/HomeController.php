<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke() {
        if (auth()->id()) {
            $this->checkPendingOrders();
        }
        $categories = Category::has('products')->get();
        return view('welcome', compact('categories'));
    }

    protected function checkPendingOrders() {
        $orders = Order::with('user')->where('status', 1)->count();
        if ($orders) {
            $quantity_message = $orders == 1 ? 'orden pendiente.' : 'ordenes pendientes.';
            $message = "Usted tiene $orders $quantity_message <a class='font-bold' href='".route('orders.index')."?status=1'>Ir a pagar</a>";
            session()->flash('flash.banner', $message);
        }
    }
}
