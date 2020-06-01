<?php

use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            [ 
                'user_id' => 1,
                'item_id' => 1,
                'review' => 'Product was built and shipped faster than stated, great quality!',
                'stars' => 5,
                'created_at' => new DateTime()
            ], 
            [ 
                'user_id' => 2,
                'item_id' => 1,
                'review' => 'UPS BAD',
                'stars' => 1,
                'created_at' => new DateTime()
            ]
        ]);
    }
}
