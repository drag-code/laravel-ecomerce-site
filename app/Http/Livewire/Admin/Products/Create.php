<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $category_id = "";
    public $subcategory_id = "";
    public $brand_id = "";
    public $name = "";
    public $slug = "";
    public $description = "";
    public $price = "";
    public $quantity = "";
    public $categories = [];
    public $subcategories = [];
    public $brands = [];

    protected $rules = [
        'category_id' => 'required',
        'subcategory_id' => 'required',
        'name' => ['required', 'max:30'],
        'slug' => ['required', 'unique:products'],
        'description' => 'required',
        'brand_id' => ['required', 'max:30'],
        'price' => ['required', 'numeric', 'min:1'],
    ];

    protected $validationAttributes = [
        'category_id' => 'categoría',
        'subcategory_id' => 'subcategoría',
        'name' => 'nombre',
        'description' => 'descripción',
        'category_id' => 'categoría',
        'brand_id' => 'marca',
        'price' => 'precio',
        'quantity' => 'cantidad',
    ];

    public function mount() {
        $this->categories = Category::select('id', 'name')->get();
    }

    public function render()
    {
        return view('livewire.admin.products.create')->layout('layouts.app-admin');
    }

    public function updatedCategoryId() {
        $category = Category::find($this->category_id);
        $this->subcategories = Subcategory::select('name', 'id')->where('category_id', $this->category_id)->get();
        $this->brands = $category->brands()->select('name', 'brands.id')->get();
        $this->reset('subcategory_id', 'brand_id');
    }

    public function getSubcategoryProperty() {
        return Subcategory::find($this->subcategory_id);
    }

    public function updatedName() {
        $this->slug = Str::slug($this->name);
    }

    public function create() {
        $product = $this->validate();
        if (!$this->subcategory->color && !$this->subcategory->size) {
            $product += $this->validate(['quantity' => ['required', 'numeric', 'min:1']]);
        }
        $product = Product::create($product);
        session()->flash('message', 'Producto registrado exitosamente');
        return redirect()->route('admin.products.edit', $product);
    }
}
