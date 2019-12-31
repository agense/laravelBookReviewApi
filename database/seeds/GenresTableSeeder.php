<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            'Action and adventure', 
            'Mystery',
            'Thriller', 
            'Horror',
            'Crime', 
            'Drama', 
            'Romance',
            'Children', 
            'Fairytale',
            'Fantasy',
            'Satire',
            'Art',
            'Biography',
            'Text Book',
            'Guide',
            'Science',
            'Travel',
            'Dictionary',
            'Hystory',
            'Encyclopedia',
        ];
        foreach($genres as $genre){
            App\Genre::create([
                'name' => $genre,
            ]);
        }
    }
}
