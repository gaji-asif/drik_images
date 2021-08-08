<?php

use App\ImageChild;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $userData = [];

    public function run()
    {
            for ($i=0; $i < 1000; $i++) {
                $userData[] = [
                    'image_name' => Str::random(10),
                    'email' => Str::random(10).'@gmail.com',
                    'image_main_url' => 'https://source.unsplash.com/random',
                ];
            }


            $chunks = array_chunk($userData, 500);

            foreach ($chunks as $chunk) {
                ImageChild::insert($chunk);
            }
        }
}
