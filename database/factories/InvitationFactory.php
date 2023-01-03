<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invitation>
 */
class InvitationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        //getting a random employee_id, however every employee get one and only one invitation.
        $invited_employees = \App\Models\Invitation::pluck('employee_id');
        $employee = \App\Models\Employee::whereNotIn('id', $invited_employees)
                                            ->get()
                                            ->random();                                 
        return [
            'user_id' => \App\Models\User::all()->random()->id,
            'company_id' => $employee->company_id,
            'employee_id' => $employee->id, // password
            'status' => 'Acceptée'
        ];
    }
}