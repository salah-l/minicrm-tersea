<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\User::factory()->count(10)->create();
        \App\Models\Company::factory()->count(30)->create();
        \App\Models\Employee::factory()->count(230)->create();
        \App\Models\Invitation::factory()->count(230)->create();
        \App\Models\Audit::factory()->count(230)->create();

    }
}