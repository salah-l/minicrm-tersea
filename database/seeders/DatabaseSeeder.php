<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
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
        \App\Models\Employee::factory()->count(100)->create();
        \App\Models\Invitation::factory()->count(100)->create();

        $users_ids = \App\Models\Invitation::all()->pluck('user_id')->all();
        $companies_ids = \App\Models\Invitation::pluck('company_id')->all();
        $employees_ids = \App\Models\Invitation::pluck('employee_id')->all();

        for($i = 0; $i < 100; $i++){
            $user_name =  \App\Models\User::where('id', '=', $users_ids[$i])->pluck('name')[0];
            $company_name =  \App\Models\Company::where('id', '=', $companies_ids[$i])->pluck('name')[0];
            $employee_name =  \App\Models\Employee::where('id', '=', $employees_ids[$i])->pluck('name')[0];

            $event['event'] = "Admin \"".$user_name."\"' a invite l'employé \"".$employee_name."\" à joindre la société \"".$company_name."\"";
            $event['created_at'] = Carbon::now();
            $event['updated_at'] = Carbon::now();
            $data[] = $event;
        }

        
        \App\Models\Audit::insert($data);

    }
}