<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tasks')->truncate();
        \App\Models\Task::factory(3)->create();
    }
}
