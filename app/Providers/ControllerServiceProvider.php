<?php

namespace App\Providers;

use App\ModelControllers\CoffeeController;
use App\ModelControllers\DelicacyController;
use App\ModelControllers\SpiceController;
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
		$this->app->singleton(SpiceController::class);
		$this->app->alias(SpiceController::class, "SpiceController");
		$this->app->singleton(DelicacyController::class);
		$this->app->alias(DelicacyController::class, "DelicacyController");
	}
}