<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ingredientSeeder extends Seeder
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
                'name' => 'bacon',

            ],
            [
                'name' => 'onion',
            ],
            [
                'name' => 'fungi',

            ],
            [
                'name' => 'cheese',
            ],
            [
                'name' => 'jalapinios',

            ],

        ];

        Ingredient::insert($ingredients);
    }
}
