<?php
namespace App\Http\Traits;

use Gloudemans\Shoppingcart\Facades\Cart;

trait CartTrait {
    public function increment() {
        $this->qty += 1;
    }

    public function decrement() {
        $this->qty -= 1;
    }

    public function addItem() {
        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'price' => $this->product->price,
            'weight' => 550,
            'options' => $this->options
        ]);
        $this->stock = getAvailableQuantity($this->product->id, $this->color_id, $this->size_id);
        $this->reset('qty');
        $this->emitTo('dropdown-cart', 'render');
    }
}
