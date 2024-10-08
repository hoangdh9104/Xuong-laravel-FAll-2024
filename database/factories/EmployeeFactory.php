<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        return [
            'first_name'       => fake()->firstName ,
            'last_name'        => fake()->lastName ,
            'email'            => fake()->email ,
            'phone'            => fake()->numberBetween(0,10000) ,
            'date_of_birth'    => fake()->date('Y-m-d','1998-10-30') ,
            'hire_date'        => fake()->date() ,
            'salary'           => fake()->numberBetween(12,2023023) ,
            'is_active'        => rand(0,1) ,
            'department_id'    => fake()->numberBetween(0,10000) ,
            'manager_id'       => fake()->randomNumber() ,
            'address'          => fake()->address ,
            'profile_picture'  => random_bytes(20) ,
        ];
    }
}
