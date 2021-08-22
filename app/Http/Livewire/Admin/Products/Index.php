<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $search = "";

    public function render()
    {
        $products = Product::where('name', 'LIKE', "%".$this->search."%")->orderBy('id', 'DESC')->paginate(5);
        return view('livewire.admin.products.index', compact('products'))->layout('layouts.app-admin');
    }

    public function updatedSearch() {
        $this->resetPage();
    }
}
