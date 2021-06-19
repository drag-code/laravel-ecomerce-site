<?php

namespace App\Http\Livewire;

use App\Http\Traits\UpdateCartTrait;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class UpdateCartItemSize extends Component
{
    use UpdateCartTrait;

    public $row_id, $qty, $stock;

    public function mount() {
        $item = Cart::get($this->row_id);
        $this->qty = $item->qty;
        $this->stock = getAvailableQuantity($item->id, $item->options['color_id'], $item->options['size_id']);
    }

    public function render()
    {
        return view('livewire.update-cart-item-size');
    }
}
