<?php

namespace Database\Seeders;

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
		CustomSeeder::seedDelicacies();
	}
}
