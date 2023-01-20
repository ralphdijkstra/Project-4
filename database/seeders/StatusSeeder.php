<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statusses = [
            [
                'name' => 'Aan het bereiden'
            ],
            [
                'name' => 'In de oven'
            ],
            [
                'name' => 'Onderweg'
            ],
            [
                'name' => 'Bezorgd'
            ],
            [
                'name' => 'Geannuleerd'
            ],
        ];

        foreach($statusses as $key => $value){
            OrderStatus::create($value);
        }
    }
}
