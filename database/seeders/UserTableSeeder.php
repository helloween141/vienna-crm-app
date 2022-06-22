<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function bcrypt;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@test.ru',
            'password' => bcrypt('123'),
            'executor' => true
        ]);

        User::factory(3)->create();
    }
}
