<?php

namespace Database\Factories;

use App\Models\Addition;
use App\ValuesObject\Constants\AdditionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/*** @extends Factory<Addition> */
class AdditionFactory extends Factory
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
			'addition_type_id' => AdditionType::OTHER
		];
	}
}
