<?php

namespace Database\Seeders;

use App\Models\Topping;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $toppings = [
            [
                'name'=>'Extra kaas',
                'price'=> 1,
            ],
            [
                'name'=>'Mayo',
                'price'=> 1,
            ],
            [
                'name'=>'Uien',
                'price' => 1,
            ],

        ];
        Topping::insert($toppings);
    }
}


 // Topping::create(['name' => 'kaas']);
        // Topping::create(['name' => 'ui']);
        // Topping::create(['name' => 'sla']);
        // Topping::create(['price' => '1']);
        // Topping::create(['price' => '1']);
        // Topping::create(['price' => 1]);