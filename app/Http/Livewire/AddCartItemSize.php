<?php

namespace App\Http\Livewire;

use App\Models\Size;
use Livewire\Component;

class AddCartItemSize extends Component
{
    public $product, $sizes;
    public $size_id = "";
    public $color_id = "";
    public $qty = 1;
    public $stock = 0;
    public $colors = [];


    public function mount() {
        $this->sizes = $this->product->sizes;
    }

    public function updatedSizeId() {
        $size = Size::find($this->size_id);
        $this->colors = $size->colors;
    }

    public function updatedColorId() {
        $size = Size::find($this->size_id);
        $this->stock = $size->colors->find($this->color_id)->pivot->quantity;
    }

    public function render()
    {
        return view('livewire.add-cart-item-size');
    }
}
