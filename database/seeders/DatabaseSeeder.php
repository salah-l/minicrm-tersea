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


        //Generating dummy data for user, companies, employees, invitations
        \App\Models\User::factory()->count(10)->create();
        \App\Models\Company::factory()->count(30)->create();
        \App\Models\Employee::factory()->count(100)->create();
        \App\Models\Invitation::factory()->count(100)->create();

        //Generating dummy data for Audit while respecting previous data
        $users_ids = \App\Models\Invitation::pluck('user_id');
        $companies_ids = \App\Models\Invitation::pluck('company_id');
        $employees_ids = \App\Models\Invitation::pluck('employee_id');

        for($i = 0; $i < 100; $i++){
            $user_name =  \App\Models\User::find($users_ids[$i])->name;
            $company_name =  \App\Models\Company::find($companies_ids[$i])->name;
            $employee_name =  \App\Models\Employee::find($employees_ids[$i])->name;

            $event['event'] = "Admin \"".$user_name."\"' a invite l'employé \"".$employee_name."\" à joindre la société \"".$company_name."\"";
            $event['created_at'] = $event['updated_at'] = Carbon::now()->subHours(2);
            
            $event2['event'] = "\"".$employee_name."\" à valider l'invitation";
            $event2['created_at'] = $event2['updated_at'] = Carbon::now()->subHours(1);
            
            $event3['event'] = "\"".$employee_name."\" à confirmer son profile";
            $event3['created_at'] = $event3['updated_at'] = Carbon::now()->subHour();
            
            $data[] = $event;
            $data[] = $event2;
            $data[] = $event3;
        }

        \App\Models\Audit::insert($data);
        


        //Updating User and Employee data for easy login
        \App\Models\User::find(1)->update([
            'name' => 'Admin Test',
            'email' => 'admin@minicrm.com',
            'password' => \Hash::make('123456789')
        ]);

        \App\Models\User::find(2)->update([
            'name' => 'Karim Ghilal',
            'email' => 'karim@minicrm.com',
            'password' => \Hash::make('123456789')
        ]);


        \App\Models\Employee::find(1)->update([
            'name' => 'Employé Test',
            'email' => 'employee@company.com',
            'password' => \Hash::make('123456789')
        ]);

        \App\Models\Employee::find(2)->update([
            'name' => 'Rachid Nasser',
            'email' => 'nasser.r@company.com',
            'password' => \Hash::make('123456789')
        ]);


    }
}