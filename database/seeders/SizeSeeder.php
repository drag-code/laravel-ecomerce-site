<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::whereHas('subcategory', function (Builder $query) {
            $query->where('color', true);
            $query->where('size',  true);
        })->get();
        $sizes = ['S', 'M', 'L', 'XL', 'XXL'];
        foreach($products as $product) {
            foreach ($sizes as $size) {
                $product->sizes()->create([
                    'name' => $size
                ]);
            }
        }
    }
}
