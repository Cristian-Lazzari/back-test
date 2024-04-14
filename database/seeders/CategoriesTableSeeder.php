<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesTableSeeder extends Seeder
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
                'name'          => 'Tutti',
                'slot'          => 0,
            ],
            [
                'name'          => 'Primi',
                'slot'          => 1,
            ],
            [
                'name'          => 'Secondi',
                'slot'          => 1,
            ],
            [
                'name'          => 'Contorni',
                'slot'          => 1,
            ],
            [
                'name'          => 'Fritture',
                'slot'          => 1,     
            ],
            [
                'name'          => 'Hosomaki',
                'slot'          => 1,
            ],
            [
                'name'          => 'Hosomaki fritto',
                'slot'          => 1,
            ],
            [
                'name'          => 'Piatti Speciali',
                'slot'          => 1,
            ],
            [
                'name'          => 'Gunkan',
                'slot'          => 1,
            ],
            [
                'name'          => 'Antipasti Cucina',
                'slot'          => 1,
            ],
            [
                'name'          => 'Antipasti Freddi',
                'slot'          => 1,
            ],
            [
                'name'          => 'Piastra',
                'slot'          => 1,
            ],
            [
                'name'          => 'Nigiri',
                'slot'          => 1,
            ],
            [
                'name'          => 'Flambè',
                'slot'          => 1,
            ],
            [
                'name'          => 'Sashimi',
                'slot'          => 1,
            ],
            [
                'name'          => 'Carpacci',
                'slot'          => 1,
            ],
            [
                'name'          => 'Temaki',
                'slot'          => 1,
            ],
            [
                'name'          => 'Uramaki',
                'slot'          => 1,
            ],

            [
                'name'          => 'Vaporiera',
                'slot'          => 1,
            ],
            [
                'name'          => 'Menu-mix Sushi',
                'slot'          => 1,
            ],

            [
                'name'          => 'Bevande',
                'slot'          => 1,
            ],
            [
                'name'          => 'Birre',
                'slot'          => 1,
            ],
            [
                'name'          => 'Amari',
                'slot'          => 1,
            ],
            [
                'name'          => 'Dessert',
                'slot'          => 1,
            ],
            [
                'name'          => 'Caffetteria',
                'slot'          => 1,
            ],
            [
                'name'          => 'Grappe',
                'slot'          => 1,
            ],
            [
                'name'          => 'Vino Bianco',
                'slot'          => 1,
            ],
            [
                'name'          => 'Vino Rosè',
                'slot'          => 1,
            ],
            [
                'name'          => 'Spina',
                'slot'          => 1,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
