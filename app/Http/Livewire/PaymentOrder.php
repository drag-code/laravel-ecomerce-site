<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class PaymentOrder extends Component
{
    protected $listeners = ['payOrder'];

    public $order;

    public function mount(Order $order) {
        $this->order = $order;
    }

    public function render()
    {
        $items = json_decode($this->order->content);
        return view('livewire.payment-order', compact('items'));
    }

    public function payOrder() {
        $this->order->status = 2;
        $this->order->save();
        return redirect()->route('orders.show', $this->order);
    }
}
