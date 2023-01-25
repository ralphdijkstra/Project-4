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
                'name' => 'Kaas',
                'image' => '',
                'price' => '0.99',
            ],
            [
                'name' => 'Tomaat',
                'image' => '',
                'price' => '0.99',
            ],
            [
                'name' => 'Salami',
                'image' => '',
                'price' => '1.99',
            ],
            [
                'name' => 'Doner',
                'image' => '',
                'price' => '1.99',
            ],
            [
                'name' => 'Pepperoni',
                'image' => '',
                'price' => '1.99',
            ],
            [
                'name' => 'Tomatensaus',
                'image' => '',
                'price' => '0.99',
            ],
            [
                'name' => 'Kip',
                'image' => '',
                'price' => '1.99',
            ],
            [
                'name' => 'Tonijn',
                'image' => '',
                'price' => '2.99',
            ],
        ];
        foreach($ingredients as $key => $value){
            Ingredient::create($value);
        }
        
    }
}
