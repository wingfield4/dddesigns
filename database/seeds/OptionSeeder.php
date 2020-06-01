<?php

use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            //Height Size
            [
                'title' => 'Mini (4")',
                'description' => '',
                'price' => 0.00,
                'customization_id' => 1,
            ],
            [
                'title' => 'Small (6")',
                'description' => '',
                'price' => 10.00,
                'customization_id' => 1,
            ],
            [
                'title' => 'Large (12")',
                'description' => '',
                'price' => 20.00,
                'customization_id' => 1,
            ],
            [
                'title' => 'XL (TBD)',
                'description' => '',
                'price' => null,
                'customization_id' => 1,
            ],
            //Backing Color
            [
                'title' => 'Classic Gray',
                'description' => '',
                'price' => 0.00,
                'customization_id' => 2,
            ],
            [
                'title' => 'White',
                'description' => '',
                'price' => 0.00,
                'customization_id' => 2,
            ],
            [
                'title' => 'Distressed White',
                'description' => '',
                'price' => 0.00,
                'customization_id' => 2,
            ],
            [
                'title' => 'Black',
                'description' => '',
                'price' => 0.00,
                'customization_id' => 2,
            ],
            [
                'title' => 'Early American',
                'description' => '',
                'price' => 0.00,
                'customization_id' => 2,
            ],
            //Frame Color
            [
                'title' => 'Classic Gray',
                'description' => '',
                'price' => 0.00,
                'customization_id' => 3,
            ],
            [
                'title' => 'White',
                'description' => '',
                'price' => 0.00,
                'customization_id' => 3,
            ],
            [
                'title' => 'Distressed White',
                'description' => '',
                'price' => 0.00,
                'customization_id' => 3,
            ],
            [
                'title' => 'Black',
                'description' => '',
                'price' => 0.00,
                'customization_id' => 3,
            ],
            [
                'title' => 'Early American',
                'description' => '',
                'price' => 0.00,
                'customization_id' => 3,
            ],
            //Letter Color
            [
                'title' => 'Black',
                'description' => '',
                'price' => 0.00,
                'customization_id' => 4,
            ],
            [
                'title' => 'White',
                'description' => '',
                'price' => 0.00,
                'customization_id' => 4,
            ]
        ]);
    }
}
