<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddCartItemColor extends Component
{
    public $product;
    public $colors;
    public $stock = 0;
    public $color_id = "";
    public $qty = 1;

    public function updatedColorId() {
        $this->stock = $this->product->colors->find($this->color_id)->pivot->quantity;
    }

    public function mount() {
        $this->colors = $this->product->colors()->select(['colors.id', 'name'])->get();
    }

    public function render()
    {
        return view('livewire.add-cart-item-color');
    }
}
