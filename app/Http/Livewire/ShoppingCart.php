<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ShoppingCart extends Component
{
    public $qty;
    protected $listeners = ['render'];

    public function render()
    {
        return view('livewire.shopping-cart');
    }

    public function destroyCart() {
        Cart::destroy();
        $this->emitTo('dropdown-cart', 'render');
    }

    public function removeItem($id) {
        Cart::remove($id);
        $this->emitTo('dropdown-cart', 'render');
    }
}
