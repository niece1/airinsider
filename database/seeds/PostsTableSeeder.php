<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
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

            DB::table('posts')->insert([

                'title' => $faker->unique()->text(20),
                'body' => $faker->text(7000),
                'slug' => $faker->text(20),
                'published' => $faker->boolean(50),
                'viewed' => $faker->numberBetween(1, 1000),
                'time_to_read' => $faker->numberBetween(1, 10),
                'user_id' => $faker->numberBetween(1, 7),
                'category_id' => $faker->numberBetween(1, 7),
            ]);
        }
    }
}
