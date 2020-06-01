<?php

use Illuminate\Database\Seeder;

class ItemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_types')->insert([
            [ 'title' => 'Made to Order' ],
            [ 'title' => 'Order Now' ],
        ]);
    }
}
