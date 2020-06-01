<?php

use Illuminate\Database\Seeder;

class ItemImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_images')->insert([
            [ 
                'item_id' => 1,
                'image_id' => 1,
                'order' => 1
            ],
            [ 
                'item_id' => 1,
                'image_id' => 2,
                'order' => 2
            ],
            [ 
                'item_id' => 1,
                'image_id' => 3,
                'order' => 4
            ],
            [ 
                'item_id' => 1,
                'image_id' => 4,
                'order' => 5
            ],
            [ 
                'item_id' => 1,
                'image_id' => 5,
                'order' => 3
            ]
        ]);
    }
}
