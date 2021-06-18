<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Searchbar extends Component
{
    public $search;
    public $products = [];
    public $open = false;

    public function render()
    {
        $this->products = $this->search !== "" ?
            Product::where('name', 'LIKE', "%$this->search%")
                ->where('status', 2)
                ->take(8)
                ->get()
            : [];
        return view('livewire.searchbar');
    }

    public function updatedSearch() {
        $this->open = $this->search !== "";
    }
}
