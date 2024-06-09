<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Photo;
use Illuminate\Support\Str;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $photo = new Photo();
            $photo->title = $faker->words(4, true);
            $photo->description = $faker->text();
            $photo->upload_image = $faker->imageUrl(600, 400, 'Photos', true, $photo->title, true, 'jpg');
            $photo->slug = Str::of($photo->title)->slug('-');
            $photo->save();
        }
    }
}
