<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategories = [
            [
                'category_id' => 1,
                'name' => 'Smartphones',
                'slug' => Str::slug('Smartphones'),
                'color' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Accesorios para smartphones',
                'slug' => Str::slug('Accesorios para celulares'),
                'color' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches')
            ],
            [
                'category_id' => 1,
                'name' => 'Auriculares',
                'slug' => Str::slug('Auriculares'),
                'color' => true
            ],
            [
                'category_id' => 2,
                'name' => 'Embutidos',
                'slug' => Str::slug('Embutidos')
            ],
            [
                'category_id' => 2,
                'name' => 'Congelados',
                'slug' => Str::slug('Congelados')
            ],
            [
                'category_id' => 3,
                'name' => 'Casual',
                'slug' => Str::slug('Casual'),
                'size' => true,
                'color' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Formal',
                'slug' => Str::slug('Formal'),
                'size' => true,
                'color' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Sofas',
                'slug' => Str::slug('Formal'),
                'size' => true,
                'color' => true
            ],
            [
                'category_id' => 5,
                'name' => 'Muebles',
                'slug' => Str::slug('Formal'),
                'size' => true,
                'color' => true
            ],
        ];

        foreach ($subcategories as $subcategory) {
            Subcategory::factory(1)->create($subcategory);
        }
    }
}
