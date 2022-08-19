<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $locales = ['en'];

        $faker = Factory::create(Arr::random($locales));

        DB::table('categories')->insert([
            'name' => "Mobile Phone",
        ]);
        DB::table('categories')->insert([
            'name' => "Laptop & PC",

        ]);
        DB::table('categories')->insert([
            'name' => "Furniture",
        ]);
        DB::table('categories')->insert([
            'name' => "Food and Drink",
        ]);

        DB::table('items')->insert([
            'name' => "Iphone 11",
            'description' => $faker->realText,
            'price' => "2300.00",
            'category_id' => "1",
            'vote' => '15',
            'rating' => '4'
        ]);

        DB::table('items')->insert([
            'name' => "Iphone 13 Pro Max",
            'description' => $faker->realText,
            'price' => "5800.00",
            'category_id' => "1",
            'vote' => '50',
            'rating' => '3'
        ]);

        DB::table('items')->insert([
            'name' => "Asus ROG Gaming Laptop",
            'description' => $faker->realText,
            'price' => "4099.00",
            'category_id' => "2",
            'vote' => '23',
            'rating' => '5'
        ]);

        DB::table('items')->insert([
            'name' => "Nasi Kandar Subaidah",
            'description' => $faker->realText,
            'price' => "10.00",
            'category_id' => "4",
            'vote' => '97',
            'rating' => '4'
        ]);

        DB::table('items')->insert([
            'name' => "Kerusi Gaming Todak",
            'description' => $faker->realText,
            'price' => "1200.00",
            'category_id' => "3",
            'vote' => '56',
            'rating' => '4'
        ]);

    }
}
