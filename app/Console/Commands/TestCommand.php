<?php

namespace App\Console\Commands;

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
		} catch (Throwable $e) {
			echo $e->getMessage();
		}
	}
}
