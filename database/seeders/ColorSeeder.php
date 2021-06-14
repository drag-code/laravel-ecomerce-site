<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = ['red', 'green', 'blue', 'black', 'yellow', 'gray', 'pink', 'white'];
        foreach ($colors as $color) {
            Color::create([
                'name' => $color
            ]);
        }
    }
}
