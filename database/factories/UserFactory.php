<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/*** @extends Factory<User> */
class UserFactory extends Factory
{
	/**
	 * Define the model's default state.
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'email' => $this->faker->email(),
			'password' => Hash::make($this->faker->password()),
			'is_admin' => $this->faker->boolean()
		];
	}
}
