<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function bcrypt;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->truncate();
        \App\Models\User::factory(1)->create([
            'name' => 'admin',
            'email' => 'admin@test.ru',
            'password' => bcrypt('123')
        ]);
    }
}
