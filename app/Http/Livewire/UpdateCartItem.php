<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Traits\UpdateCartTrait;

class UpdateCartItem extends Component
{
    use UpdateCartTrait;

    public $row_id, $qty, $stock;

    public function mount() {
        $item = Cart::get($this->row_id);
        $this->qty = $item->qty;
        $this->stock = getAvailableQuantity($item->id);
    }

    public function render()
    {
        return view('livewire.update-cart-item');
    }
}
