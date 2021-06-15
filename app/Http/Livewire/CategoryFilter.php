<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class CategoryFilter extends Component
{
    use WithPagination;

    public $category, $selected_subcategory, $selected_brand;
    public $display = 'grid';

    public function render()
    {
        /*$products = $this->category->products()->where('status', 2)->paginate(20);*/
        $productsQuery = Product::query()->whereHas('subcategory.category', function (Builder $query) {
            $query->where('id', $this->category->id);
        });

        if ($this->selected_subcategory) {
            $productsQuery = $productsQuery->whereHas('subcategory', function (Builder $query) {
                $query->where('name', $this->selected_subcategory);
            });
        }

        if ($this->selected_brand) {
            $productsQuery = $productsQuery->whereHas('brand', function (Builder $query) {
                $query->where('name', $this->selected_brand);
            });
        }

        if ($this->selected_brand && $this->selected_subcategory) {
            $productsQuery = $productsQuery
                ->whereHas('brand', function (Builder $query) {
                    $query->where('name', $this->selected_brand);
                })
            ->whereHas('subcategory', function (Builder $query) {
                $query->where('name', $this->selected_subcategory);
            });
        }
        $products = $productsQuery->paginate(20);
        return view('livewire.category-filter', compact('products'));
    }

    public function removeFilters()
    {
        $this->reset(['selected_subcategory', 'selected_brand']);
    }
}
