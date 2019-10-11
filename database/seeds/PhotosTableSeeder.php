<?php

use Illuminate\Database\Seeder;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 1; $i <= 100; $i++) {
            DB::table('photos')->insert([
                'photoable_type' => 'App\Post',
                'photoable_id' => $faker->numberBetween(1, 100),
                'path' => $faker->imageUrl(760, 500, 'city')
            ]);
        }
        for ($i = 1; $i <= 7; $i++) {
            DB::table('photos')->insert([
                'photoable_type' => 'App\User',
                'photoable_id' => $faker->numberBetween(1, 7),
                'path' => $faker->imageUrl(100, 100, 'people')
            ]);
        }
    }
}
