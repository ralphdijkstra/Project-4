<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = [
            [
                'name' => 'Mozzarella kaas',
                'image' => '',
                'price' => '0.99',
            ],
            [
                'name' => 'Gouda kaas',
                'image' => '',
                'price' => '0.99',
            ],
            [
                'name' => 'Cheddar kaas',
                'image' => '',
                'price' => '0.99',
            ],
            [
                'name' => 'Zachte franse kaas',
                'image' => '',
                'price' => '0.99',
            ],
            [
                'name' => 'Tomatensaus',
                'image' => '',
                'price' => '0.99',
            ],
            [
                'name' => 'Pizzakruiden',
                'image' => '',
                'price' => '0.99',
            ],
            [
                'name' => 'Champignons',
                'image' => '',
                'price' => '0.99',
            ],
            [
                'name' => 'Pepperoni',
                'image' => '',
                'price' => '0.99',
            ],
            [
                'name' => 'Salami',
                'image' => '',
                'price' => '0.99',
            ],
            [
                'name' => 'Ham',
                'image' => '',
                'price' => '0.99',
            ],
            [
                'name' => 'Ananas',
                'image' => '',
                'price' => '0.99',
            ],
            [
                'name' => 'Spinazie',
                'image' => '',
                'price' => '0.99',
            ],
            [
                'name' => 'Tomaat',
                'image' => '',
                'price' => '2.99',
            ],
            [
                'name' => 'Tonijn',
                'image' => '',
                'price' => '2.99',
            ],
            [
                'name' => 'Rode ui',
                'image' => '',
                'price' => '2.99',
            ],
        ];

        foreach($ingredients as $key => $value){
            Ingredient::create($value);
        }
    }
}
