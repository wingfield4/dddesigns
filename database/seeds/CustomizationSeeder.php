<?php

use Illuminate\Database\Seeder;

class CustomizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customizations')->insert([
            [
                'title' => 'Height Size',
                'description' => 'Price includes 5 words or less. Additional words are $2 per character.',
                'allow_custom_option' => false,
                'custom_option_description' => null,
                'item_id' => 1,
                'image_id' => null,
                'customization_type_id' => 2,
                'free_text_min_length' => null,
                'free_text_max_length' => null,
                'required' => true
            ],
            [
                'title' => 'Backing Color',
                'description' => '',
                'allow_custom_option' => false,
                'custom_option_description' => null,
                'item_id' => 1,
                'image_id' => null,
                'customization_type_id' => 2,
                'free_text_min_length' => null,
                'free_text_max_length' => null,
                'required' => true
            ],
            [
                'title' => 'Frame Color',
                'description' => '',
                'allow_custom_option' => false,
                'custom_option_description' => null,
                'item_id' => 1,
                'image_id' => null,
                'customization_type_id' => 2,
                'free_text_min_length' => null,
                'free_text_max_length' => null,
                'required' => true
            ],
            [
                'title' => 'Letter Color',
                'description' => '',
                'allow_custom_option' => true,
                'custom_option_description' => 'Letter Color Description',
                'item_id' => 1,
                'image_id' => null,
                'customization_type_id' => 2,
                'free_text_min_length' => null,
                'free_text_max_length' => null,
                'required' => true
            ],
            [
                'title' => 'Handwriting Phrase',
                'description' => 'This is the phrase that will appear on your sign',
                'allow_custom_option' => null,
                'custom_option_description' => null,
                'item_id' => 1,
                'image_id' => null,
                'customization_type_id' => 1,
                'free_text_min_length' => 1,
                'free_text_max_length' => 100,
                'required' => true
            ],
            [
                'title' => 'Handwriting Image',
                'description' => 'This is the image of the hand-written phrase that will appear on your sign',
                'allow_custom_option' => null,
                'custom_option_description' => null,
                'item_id' => 1,
                'image_id' => null,
                'customization_type_id' => 3,
                'free_text_min_length' => null,
                'free_text_max_length' => null,
                'required' => true
            ],
            [
                'title' => 'Additional Info',
                'description' => 'Any additional notes',
                'allow_custom_option' => null,
                'custom_option_description' => null,
                'item_id' => 1,
                'image_id' => null,
                'customization_type_id' => 1,
                'free_text_min_length' => null,
                'free_text_max_length' => null,
                'required' => false
            ]
        ]);
    }
}
