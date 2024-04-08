<?php

namespace App\Providers;

use App\ModelControllers\CoffeeController;
use App\ModelControllers\DelicacyController;
use App\ModelControllers\FeedbackController;
use App\ModelControllers\QuestionController;
use App\ModelControllers\SpiceController;
use App\ModelControllers\UserController;
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
		$this->app->singleton(UserController::class);
		$this->app->alias(UserController::class, "UserController");
		$this->app->singleton(FeedbackController::class);
		$this->app->alias(FeedbackController::class, "FeedbackController");
		$this->app->singleton(QuestionController::class);
		$this->app->alias(QuestionController::class, "QuestionController");
	}
}