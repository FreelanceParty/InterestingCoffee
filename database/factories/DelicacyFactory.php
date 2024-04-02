<?php

namespace Database\Factories;

use App\Models\Delicacy;
use Illuminate\Database\Eloquent\Factories\Factory;

/*** @extends Factory<Delicacy> */
class DelicacyFactory extends Factory
{
	/**
	 * Define the model's default state.
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'title' => $this->faker->word(),
			'price' => $this->faker->randomFloat(2, 0, 200)
		];
	}
}
