<?php

namespace App\Http\Livewire;

use App\Http\Traits\CartTrait;
use Livewire\Component;

class AddCartItem extends Component
{
    use CartTrait;

    public $product;
    public $qty = 1;
    public $stock = 0;
    public $color_id = null;
    public $size_id = null;
    public $options = [
        'color_id' => null,
        'size_id' => null
    ];


    public function mount() {
        $this->stock = getAvailableQuantity($this->product->id);
        $this->options['image'] = asset('storage/'.$this->product->image->first()->url);
    }

    public function render()
    {
        return view('livewire.add-cart-item');
    }
}
