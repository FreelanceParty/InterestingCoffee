<?php

namespace Database\Seeders;

use App\Models\Addition;
use Illuminate\Database\Seeder;

/**
 * Class AdditionSeeder
 * @package Database\Seeders
 */
class AdditionSeeder extends Seeder
{
	/*** Seed the application's database. */
	public function run(): void
	{
		Addition::factory()
			->count(15)
			->create();
	}
}
