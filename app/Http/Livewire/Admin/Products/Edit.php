<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;
use Faker;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{

    public $product;
    public $category_id;
    public $categories = [];
    public $subcategories = [];
    public $brands = [];
    public $slug;

    protected $rules = [
        'category_id' => 'required',
        'product.subcategory_id' => 'required',
        'product.name' => ['required', 'max:30'],
        'slug' => ['required', 'unique:products,slug'],
        'product.description' => 'required',
        'product.brand_id' => ['required', 'max:30'],
        'product.price' => ['required', 'numeric', 'min:1'],
        'product.quantity' => ['numeric']
    ];

    public function mount(Product $product) {
        $this->product = $product;
        $this->slug = $this->product->slug;
        $this->categories = Category::select('id', 'name')->get();
        $this->category_id = $this->product->subcategory->category->id;
        $this->subcategories = Subcategory::select('name', 'id')->where('category_id', $this->category_id)->get();
        $category = Category::find($this->category_id);
        $this->brands = $category->brands()->select('name', 'brands.id')->get();
    }

    public function render()
    {
        return view('livewire.admin.products.edit')->layout('layouts.app-admin');
    }

    public function updatedProductName($slug) {
        $this->slug = Str::slug($slug);
    }

    public function updatedCategoryId() {
        $category = Category::find($this->category_id);
        $this->subcategories = Subcategory::select('name', 'id')->where('category_id', $this->category_id)->get();
        $this->brands = $category->brands()->select('name', 'brands.id')->get();
        $this->product->subcategory_id = "";
        $this->product->brand_id = "";
    }

    public function getSubcategoryProperty() {
        return Subcategory::find($this->product->subcategory_id);
    }

    public function create() {
        $rules = $this->rules;
        $rules['slug'] = ['required', 'unique:products,slug,'.$this->product->id];
        if($this->product->subcategory_id) {
            if (!$this->subcategory->color && !$this->subcategory->size) {
                $rules['product.quantity'] = ['required', 'numeric'];
            }
        }
        $this->validate($rules);
        $this->product->slug = $this->slug;
        DB::transaction(function() {
            $faker = Faker\Factory::create();
            $this->product->save();
            Image::create([
                'url' => 'products/' . $faker->image(public_path('storage/products'), 640, 480, null, false),
                'imageable_id' => $this->product->id,
                'imageable_type' => Product::class
            ]);
        });
        $this->emit('updated');
    }
}
