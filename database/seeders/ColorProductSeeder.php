<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;

class ColorProductSeeder extends Seeder
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
            $query->where('size',  false);
        })->get();
        foreach($products as $product) {
            $product->colors()->attach([
                1 => ['quantity' => 10],
                2 => ['quantity' => 10],
                3 => ['quantity' => 10],
                4 => ['quantity' => 10],
                5 => ['quantity' => 10],
                6 => ['quantity' => 10],
                7 => ['quantity' => 10],
                8 => ['quantity' => 10],
            ]);
        }
    }
}
