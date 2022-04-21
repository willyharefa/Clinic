<?php

namespace Database\Factories;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
            return [
                'name' => $this->faker->name(),
                'gender' => 'Pria',
                'birthday' => $this->faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('Y/m/d'),
                'username' => $this->faker->userName(),
                'address' => $this->faker->streetAddress(),
                'phone' => $this->faker->phoneNumber(),
                'email' => $this->faker->unique()->safeEmail(),
                'password' => Hash::make(123123), 
            ];

    }
    
}

