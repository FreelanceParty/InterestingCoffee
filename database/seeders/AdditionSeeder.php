<?php

namespace Database\Seeders;

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
		CustomSeeder::seedAdditions();
	}
}
