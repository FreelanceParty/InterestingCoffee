<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Class UserSeeder
 * @package Database\Seeders
 */
class UserSeeder extends Seeder
{
	/*** Seed the application's database. */
	public function run(): void
	{
		User::factory()
			->count(20)
			->create();
	}
}
