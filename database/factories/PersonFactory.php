<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     public function definition()
    {
        $first = $this->faker->firstName;
        $last = $this->faker->lastName;
        $user = User::factory(['name' => $first . ' ' . $last])->create();
        return [
            'id' => $user->id,
            'first_name' => $first,
            'last_name' => $last,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'postal_code' => $this->faker->postcode,
            'country' => $this->faker->country,
            'date_of_birth' => $this->faker->date,
            'personal_email' => $this->faker->unique()->safeEmail,
            'burger_service_nummer' => $this->faker->randomNumber(9),
            'notes' => $this->faker->text,
        ];
    }
}
