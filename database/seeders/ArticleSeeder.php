<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Str sınıfını dahil ediyoruz
use Faker\Factory as Faker; // Faker kütüphanesini dahil ediyoruz

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 4; $i++) {
            $title = $faker->sentence(6); // Başlık oluşturuyoruz

            DB::table('articles')->insert([
                'category_id' => rand(1, 7),
                'title' => $title,
                'image' => $faker->imageUrl(800, 400, 'technology', true),
                'content' => $faker->paragraph(6), // İçerik oluşturuyoruz
                'slug' => Str::slug($title), // Başlıktan slug oluşturuyoruz
                'created_at' => $faker->dateTime('now'),
                'updated_at' => now()
            ]);
        }
    }
}
