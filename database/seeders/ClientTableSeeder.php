<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('clients')->truncate();
        \App\Models\Client::factory(3)->create();
    }
}
