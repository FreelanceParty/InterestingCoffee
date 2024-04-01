<?php

namespace App\Providers;

use App\ModelControllers\CoffeeController;
use Illuminate\Support\ServiceProvider;

/**
 * Class ControllerServiceProvider
 * @package App\Providers
 */
class ControllerServiceProvider extends ServiceProvider
{
	/*** @return void */
	public function boot(): void
	{
		$this->app->singleton(CoffeeController::class);
		$this->app->alias(CoffeeController::class, 'CoffeeController');
	}

}