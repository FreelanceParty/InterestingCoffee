<?php

namespace Database\Seeders;

use App\Models\Spice;
use Illuminate\Database\Seeder;

/**
 * Class SpiceSeeder
 * @package Database\Seeders
 */
class SpiceSeeder extends Seeder
{
	/*** Seed the application's database. */
	public function run(): void
	{
		Spice::factory()
			->count(20)
			->create();
	}
}
