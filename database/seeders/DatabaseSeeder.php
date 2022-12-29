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

        User::factory()->count(10)->create();
        Company::factory()->count(30)->create();
        Employee::factory()->count(230)->create();
        Invitation::factory()->count(230)->create();
        Audit::factory()->count(230)->create();

    }
}