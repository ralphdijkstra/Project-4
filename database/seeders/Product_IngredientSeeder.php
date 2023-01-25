<?php

namespace Database\Seeders;

use App\Models\Product_Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Product_IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products_ingredients = [
            [
                'product_id' => '1',
                'ingredient_id' => '1',
            ],
            [
                'product_id' => '1',
                'ingredient_id' => '5',
            ],
            [
                'product_id' => '1',
                'ingredient_id' => '6',
            ],
            [
                'product_id' => '2',
                'ingredient_id' => '1',
            ],
            [
                'product_id' => '2',
                'ingredient_id' => '5',
            ],
            [
                'product_id' => '2',
                'ingredient_id' => '9',
            ],
            [
                'product_id' => '3',
                'ingredient_id' => '1',
            ],
            [
                'product_id' => '3',
                'ingredient_id' => '5',
            ],
            [
                'product_id' => '3',
                'ingredient_id' => '10',
            ],
            [
                'product_id' => '3',
                'ingredient_id' => '11',
            ],
            [
                'product_id' => '4',
                'ingredient_id' => '1',
            ],
            [
                'product_id' => '4',
                'ingredient_id' => '5',
            ],
            [
                'product_id' => '4',
                'ingredient_id' => '6',
            ],
            [
                'product_id' => '4',
                'ingredient_id' => '7',
            ],
            [
                'product_id' => '5',
                'ingredient_id' => '1',
            ],
            [
                'product_id' => '5',
                'ingredient_id' => '5',
            ],
            [
                'product_id' => '5',
                'ingredient_id' => '8',
            ],
            [
                'product_id' => '6',
                'ingredient_id' => '1',
            ],
            [
                'product_id' => '6',
                'ingredient_id' => '5',
            ],
            [
                'product_id' => '6',
                'ingredient_id' => '12',
            ],
            [
                'product_id' => '6',
                'ingredient_id' => '13',
            ],
            [
                'product_id' => '7',
                'ingredient_id' => '1',
            ],
            [
                'product_id' => '7',
                'ingredient_id' => '5',
            ],
            [
                'product_id' => '7',
                'ingredient_id' => '14',
            ],
            [
                'product_id' => '7',
                'ingredient_id' => '15',
            ],
            [
                'product_id' => '8',
                'ingredient_id' => '1',
            ],
            [
                'product_id' => '8',
                'ingredient_id' => '2',
            ],
            [
                'product_id' => '8',
                'ingredient_id' => '3',
            ],
            [
                'product_id' => '8',
                'ingredient_id' => '4',
            ],
            [
                'product_id' => '8',
                'ingredient_id' => '5',
            ],
        ];

        foreach($products_ingredients as $key => $value){
            Product_Ingredient::create($value);
        }
    }
}
