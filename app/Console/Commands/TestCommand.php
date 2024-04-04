<?php

namespace App\Console\Commands;

use App\Models\Coffee;
use Illuminate\Console\Command;
use Throwable;

/**
 * Class TestCommand
 * @package App\Console\Commands
 */
class TestCommand extends Command
{
	/*** @var string */
	protected $signature = 'app:test-command';

	/*** @var string */
	protected $description = 'Command for some functional testing';

	/*** @return void */
	public function handle(): void
	{
		try {
			$coffee = Coffee::all()->first();
			$coffee->setImage((file_get_contents(public_path('images/cookie-default-img.png'))));
			$coffee->save();
		} catch (Throwable $e) {
			echo $e->getMessage();
		}
	}
}
