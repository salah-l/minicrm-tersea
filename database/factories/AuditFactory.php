<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Audit>
 */
class AuditFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user_id = \App\Models\Invitation::pluck('user_id')->all()->random()->id;
        $user_name = \App\Models\User::where('id', '=', $user_id)->name;
        $company_id = \App\Models\Invitation::where('user_id', '=', $user_id)->random()->id;
        $company_name = \App\Models\Company::where('id', '=', $company_id)->name;
        $employee_id = \App\Models\Invitation::where('user_id', '=', $user_id)
                                             ->where('company_id', '=', $company_id)->id;
        $employe_name = \App\Models\Employee::where('id', '=', $employee_id)->name;
        return [
            'event' => "Admin \"".$user_name."\"' a invite l'employé \"".$employe_name."\" à joindre la société \"".$company_name."\""
        ];
    }
}