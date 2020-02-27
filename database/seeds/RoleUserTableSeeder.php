<?php

use Illuminate\Database\Seeder;
use App\User;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::findOrFail(1)->roles()->sync(1);
    }
}
