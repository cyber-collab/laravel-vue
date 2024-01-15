<?php

namespace Database\Factories;

use App\Models\Position;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'company_id' => Company::inRandomOrder()->first()->id,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
        ];
    }
}
