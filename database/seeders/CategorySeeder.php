<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Electrónica',
                'slug' => Str::slug('Electrónica'),
                'icon' => '<i class="fas fa-plug"></i>',
            ],
            [
                'name' => 'Alimentos',
                'slug' => Str::slug('Alimentos'),
                'icon' => '<i class="fas fa-drumstick-bite"></i>',
            ],
            [
                'name' => 'Ropa',
                'slug' => Str::slug('Ropa'),
                'icon' => '<i class="fas fa-tshirt"></i>',
            ],
            [
                'name' => 'Calzado',
                'slug' => Str::slug('Calzado'),
                'icon' => '<i class="fas fa-shoe-prints"></i>',
            ],
            [
                'name' => 'Hogar',
                'slug' => Str::slug('Hogar'),
                'icon' => '<i class="fas fa-home"></i>',
            ],
        ];

        foreach ($categories as $category) {
            $category = Category::factory(1)->create($category)->first();
            $brands = Brand::factory(4)->create();
            foreach($brands as $brand) {
                $brand->categories()->attach($category->id);
            }
        }
    }
}
