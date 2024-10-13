<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Passport>
 */
class PassportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'passport_number'   => fake()->numberBetween(10000, 10000000),
            'issued_date'       => fake()->date(),
            'expiry_date'       => fake()->date(),
            'student_id'        => Student::factory(),
        ];
    }
}
