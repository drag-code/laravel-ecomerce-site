<?php
namespace App\Http\Traits;

use Gloudemans\Shoppingcart\Facades\Cart;

trait UpdateCartTrait {
    public function increment() {
        $this->qty += 1;
        Cart::update($this->row_id, $this->qty);
        $this->emitTo('dropdown-cart', 'render');
        $this->emitTo('shopping-cart', 'render');
    }

    public function decrement() {
        $this->qty -= 1;
        Cart::update($this->row_id, $this->qty);
        $this->emitTo('dropdown-cart', 'render');
        $this->emitTo('shopping-cart', 'render');
    }
}
