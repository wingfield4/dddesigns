<?php

use Illuminate\Database\Seeder;

class CustomizationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customization_types')->insert([
            [ 'title' => 'Free Text' ],
            [ 'title' => 'Options' ],
            [ 'title' => 'Image Upload' ]
        ]);
    }
}
