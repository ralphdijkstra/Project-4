<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'name' => 'Pizzas'
            ],
            [
                'name' => 'Side dishes'
            ],
            [
                'name' => 'Drinks'
            ],
            [
                'name' => 'Desserts'
            ],
        ];

        foreach($categories as $key => $value){
            Category::create($value);
        }
    }
}
