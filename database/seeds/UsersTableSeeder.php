<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 1; $i <= 7; $i++) {

            DB::table('users')->insert([

                'name' => $faker->firstName,
                'email' => $faker->email,
                'password' => bcrypt('passw'),
            ]);
        }
    }
}
