<?php

namespace App\Http\Livewire;

use App\Http\Traits\CartTrait;
use Livewire\Component;

class AddCartItemColor extends Component
{
    use CartTrait;

    public $product;
    public $colors;
    public $stock = 0;
    public $color_id = "";
    public $size_id = null;
    public $qty = 1;
    public $options = [
        'size_id' => null
    ];

    public function updatedColorId() {
        $current_color = $this->product->colors->find($this->color_id);
        $this->options['color_id'] = $current_color->id;
        $this->options['color_name'] = $current_color->name;
        $this->stock = getAvailableQuantity($this->product->id, $this->color_id);
    }

    public function mount() {
        $this->colors = $this->product->colors()->select(['colors.id', 'name'])->get();
        $this->options['image'] = asset('storage/'.$this->product->image->first()->url);
    }

    public function render()
    {
        return view('livewire.add-cart-item-color');
    }
}
