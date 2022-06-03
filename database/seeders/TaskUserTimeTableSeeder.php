<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskUserTimeTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('task_user_times')->truncate();
        \App\Models\TaskUserTime::factory(10)->create();
    }
}
