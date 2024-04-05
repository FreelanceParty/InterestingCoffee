<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Seeder;

/**
 * Class FeedbackSeeder
 * @package Database\Seeders
 */
class FeedbackSeeder extends Seeder
{
	/*** Seed the application's database. */
	public function run(): void
	{
		Feedback::factory()
			->count(20)
			->create();
	}
}
