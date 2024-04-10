<?php

namespace Database\Seeders;

use App\Models\Delicacy;
use Illuminate\Database\Seeder;

/**
 * Class DelicacySeeder
 * @package Database\Seeders
 */
class DelicacySeeder extends Seeder
{
	/*** Seed the application's database. */
	public function run(): void
	{
		Delicacy::factory()
			->count(15)
			->create();
	}
}
