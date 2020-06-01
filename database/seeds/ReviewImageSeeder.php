<?php

use Illuminate\Database\Seeder;

class ReviewImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('review_images')->insert([
            [ 
                'review_id' => 1,
                'image_id' => 2
            ], 
            [ 
                'review_id' => 1,
                'image_id' => 3
            ], 
            [ 
                'review_id' => 1,
                'image_id' => 4
            ], 
            [ 
                'review_id' => 1,
                'image_id' => 5
            ]
        ]);
    }
}
