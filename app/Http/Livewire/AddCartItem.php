<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddCartItem extends Component
{
    public $product;
    public $qty = 1;
    public $stock = 0;

    public function mount() {
        $this->stock = $this->product->quantity;
    }

    public function render()
    {
        return view('livewire.add-cart-item');
    }

    public function increment() {
        $this->qty += 1;
    }

    public function decrement() {
        $this->qty -= 1;
    }

}
