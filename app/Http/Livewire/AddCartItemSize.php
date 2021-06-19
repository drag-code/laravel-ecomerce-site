<?php

namespace App\Http\Livewire;

use App\Http\Traits\CartTrait;
use App\Models\Size;
use Livewire\Component;

class AddCartItemSize extends Component
{
    use CartTrait;

    public $product, $sizes;
    public $size_id = "";
    public $color_id = "";
    public $qty = 1;
    public $stock = 0;
    public $colors = [];
    public $options = [];


    public function mount() {
        $this->sizes = $this->product->sizes;
        $this->options['image'] = asset('storage/'.$this->product->image->first()->url);
    }

    public function updatedSizeId() {
        $size = Size::find($this->size_id);
        $this->colors = $size->colors;
        $this->options['size_id'] = $size->id;
        $this->options['size_name'] = $size->name;
    }

    public function updatedColorId() {
        $size = Size::find($this->size_id);
        $color = $size->colors->find($this->color_id);
        $this->options['color_id'] = $color->id;
        $this->options['color_name'] = $color->name;
        $this->stock = getAvailableQuantity($this->product->id, $this->color_id, $this->size_id);
    }

    public function render()
    {
        return view('livewire.add-cart-item-size');
    }
}
