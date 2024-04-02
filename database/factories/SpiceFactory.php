<?php

namespace Database\Factories;

use App\Models\Spice;
use Illuminate\Database\Eloquent\Factories\Factory;

/*** @extends Factory<Spice> */
class SpiceFactory extends Factory
{
	/**
	 * Define the model's default state.
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'title' => $this->faker->word(),
			'price' => $this->faker->randomFloat(2, 0, 200),
		];
	}
}
