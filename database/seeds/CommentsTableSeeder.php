<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 1; $i <= 10; $i++) {

            DB::table('comments')->insert([
                'user_id' => $faker->numberBetween(1, 7),
                'post_id' => $faker->numberBetween(1, 100),
                'body' => $faker->sentence(5),
                'comment_id' => null,
            ]);
        }
    }
}
