<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Color;
use App\Models\Product;
use Livewire\Component;
use App\Models\ColorProduct as Pivot;

class ColorProduct extends Component
{
    public $product;
    public $colors = [];
    public $color_id = "";
    public $quantity;
    public $open = false;
    public $pivot;
    public $pivot_color_id;
    public $pivot_quantity;

    protected $listeners = ['destroy'];

    protected $rules = [
        'color_id' => 'required',
        'quantity' => ['required', 'numeric']
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->colors = Color::select('id', 'name')->get();
    }

    public function render()
    {
        $added_colors = $this->product->colors;
        return view('livewire.admin.products.color-product', compact('added_colors'));
    }

    public function create()
    {
        $this->validate();
        $pivot = Pivot::where('color_id', $this->color_id)->where('product_id', $this->product->id)->first();
        if($pivot) {
            $pivot->quantity += $this->quantity;
            $pivot->save();
        } else {
            $this->product->colors()->attach([
                $this->color_id => [
                    'quantity' => $this->quantity
                ]
            ]);
        }
        $this->reset(['quantity', 'color_id']);
        $this->emit('saved');
        $this->product = $this->product->fresh();
    }

    public function edit(Pivot $pivot)
    {
        $this->open = true;
        $this->pivot = $pivot;
        $this->pivot_color_id = $pivot->color_id;
        $this->pivot_quantity = $pivot->quantity;
    }

    public function update()
    {
        $this->pivot->color_id = $this->pivot_color_id;
        $this->pivot->quantity = $this->pivot_quantity;
        $this->pivot->save();
        $this->emit('saved');
        $this->product = $this->product->fresh();
        $this->reset('open');
    }

    public function destroy(Pivot $pivot)
    {
        $pivot->delete();
        $this->product = $this->product->fresh();
    }
}
