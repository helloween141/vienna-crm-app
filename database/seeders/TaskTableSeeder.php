<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tasks')->truncate();

        $user = User::whereEmail('admin@test.ru')->first();

        Task::factory(5)->for($user)->create();
    }
}
