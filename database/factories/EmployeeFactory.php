<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => 'testPass', // password
            'company_id' => \App\Models\Company::all()->random()->id,
            'address' => fake()->streetAddress(),
            'phone' => fake()->phoneNumber(),
            'birthdate' => fake()->dateTimeBetween($startDate = '-50 years', $endDate = '-20 years', $timezone = null), // password
            'token_expiry_date' => Carbon::now(),
            'is_verified' => true
        ];
    }
}