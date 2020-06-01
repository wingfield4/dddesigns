<?php

use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            [ 
                'title' => 'Handwriting Example',
                'description' => 'This is an example piece featuring the handwriting of...',
                'small_path' => 'handwriting.jpg',
                'medium_path' => 'handwriting.jpg',
                'full_path' => 'handwriting.jpg'
            ],
            [ 
                'title' => 'Handwriting Example 2',
                'description' => 'This is an example piece featuring the handwriting of...',
                'small_path' => 'handwriting2.jpg',
                'medium_path' => 'handwriting2.jpg',
                'full_path' => 'handwriting2.jpg'
            ],
            [ 
                'title' => 'Handwriting Example 3',
                'description' => 'This is an example piece featuring the handwriting of...',
                'small_path' => 'handwriting3.jpg',
                'medium_path' => 'handwriting3.jpg',
                'full_path' => 'handwriting3.jpg'
            ],
            [ 
                'title' => 'Handwriting Example 4',
                'description' => 'This is an example piece featuring the handwriting of...',
                'small_path' => 'handwriting4.jpg',
                'medium_path' => 'handwriting4.jpg',
                'full_path' => 'handwriting4.jpg'
            ],
            [ 
                'title' => 'Handwriting Example 5',
                'description' => 'This is an example piece featuring the handwriting of...',
                'small_path' => 'handwriting5.jpg',
                'medium_path' => 'handwriting5.jpg',
                'full_path' => 'handwriting5.jpg'
            ],
        ]);
    }
}
