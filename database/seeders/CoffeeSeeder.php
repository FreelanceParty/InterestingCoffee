<?php

namespace Database\Seeders;

use App\Models\Coffee;
use Illuminate\Database\Seeder;

/**
 * Class CoffeeSeeder
 * @package Database\Seeders
 */
class CoffeeSeeder extends Seeder
{
	/*** Seed the application's database. */
	public function run(): void
	{
		Coffee::factory()
			->count(15)
			->create();
	}
}
