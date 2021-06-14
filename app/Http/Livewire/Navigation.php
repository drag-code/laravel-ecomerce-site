<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class Navigation extends Component
{
    public $categories;

    public function mount() {
        $this->categories = Category::with('subcategories')->get();
    }

    public function render()
    {
        return view('livewire.navigation');
    }

}
