<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Pizza Margaritha',
                'description' => 'Tomatensaus, mozzarella en pizzakruiden',
                'image' => '',
                'price' => '7.99',
                'category_id' => '1',
            ],
            [
                'name' => 'Pizza Salami',
                'description' => 'Tomatensaus, mozzarella en salami',
                'image' => '',
                'price' => '9.99',
                'category_id' => '1',
            ],
            [
                'name' => 'Pizza Hawaii',
                'description' => 'Tomatensaus, mozzarella, ham en ananas',
                'image' => '',
                'price' => '9.99',
                'category_id' => '1',
            ],
            [
                'name' => 'Pizza Funghi',
                'description' => 'Tomatensaus, mozzarella en champignons',
                'image' => '',
                'price' => '9.99',
                'category_id' => '1',
            ],
            [
                'name' => 'Pizza Pepperoni',
                'description' => 'Tomatensaus, mozzarella en pepperoni',
                'image' => '',
                'price' => '9.99',
                'category_id' => '1',
            ],
            [
                'name' => 'Pizza Caprese',
                'description' => 'Tomatensaus, mozzarella, spinazie, tomaat en pesto',
                'image' => '',
                'price' => '11.99',
                'category_id' => '1',
            ],
            [
                'name' => 'Pizza Tonno',
                'description' => 'Tomatensaus, mozzarella, rode ui en tonijn',
                'image' => '',
                'price' => '11.99',
                'category_id' => '1',
            ],
            [
                'name' => 'Pizza Four Cheese',
                'description' => 'Tomatensaus, mozzarella, gouda, cheddar en franse kaas',
                'image' => '',
                'price' => '12.99',
                'category_id' => '1',
            ],
        ];

        foreach($products as $key => $value){
            Product::create($value);
        }
    }
}
