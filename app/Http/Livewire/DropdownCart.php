<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class DropdownCart extends Component
{

    public $items = 0;
    protected $listeners = ['render'];

    public function render()
    {
        $this->items = Cart::count();
        return view('livewire.dropdown-cart');
    }
}
