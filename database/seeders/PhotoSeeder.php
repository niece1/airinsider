<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\Photo;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Photo::factory()
                ->count(200)
                ->state(new Sequence(
                        ['photoable_type' => 'App\Models\Post'],
                        ['photoable_type' => 'App\Models\User'],
                ))
                ->create();
    }
}
