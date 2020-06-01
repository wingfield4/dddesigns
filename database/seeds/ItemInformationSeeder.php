<?php

use Illuminate\Database\Seeder;

class ItemInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_information')->insert([
            [
                'title' => 'Typical processing time',
                'description' => '1-2 weeks',
                'item_id' => 1
            ], 
            [
                'title' => 'Weight (Mini)',
                'description' => '5 lbs',
                'item_id' => 1
            ], 
            [
                'title' => 'Weight (Small)',
                'description' => '10 lbs',
                'item_id' => 1
            ], 
            [
                'title' => 'Weight (Large)',
                'description' => '15 lbs',
                'item_id' => 1
            ]
        ]);
    }
}
