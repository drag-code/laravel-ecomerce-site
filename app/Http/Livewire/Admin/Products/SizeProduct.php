<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product;
use App\Models\Size;
use Livewire\Component;

class SizeProduct extends Component
{

    public $product;
    public $name;
    public $name_edit;
    public $open = false;
    public $size;
    
    protected $listeners = ['destroy'];

    protected $rules = [
        'name' => 'required'
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function render()
    {
        $added_sizes = $this->product->sizes->sortByDesc('id');
        return view('livewire.admin.products.size-product', compact('added_sizes'));
    }

    public function create()
    {
        $this->validate();
        $size = Size::where('product_id', $this->product->id)->where('name', $this->name)->first();
        if($size) {
            $this->emit('showErrorAlert', 'Ya existe una talla con ese nombre');
        } else {
            $this->product->sizes()->create([
                'name' => $this->name
            ]);   
        }
        $this->reset(['name']);
        $this->emit('saved');
        $this->product = $this->product->fresh();
    }

    public function show(Size $size)
    {
        $this->open = true;
        $this->size = $size;
        $this->name_edit = $size->name;
    }

    public function edit()
    {
        $this->validate(['name_edit' => 'required']);
        $this->size->name = $this->name_edit;
        $this->size->save();
        $this->emit('saved');
        $this->product = $this->product->fresh();
    }

    public function destroy(Size $size)
    {
        $size->delete();
        $this->product = $this->product->fresh();
    }

}
