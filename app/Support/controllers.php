<?php

use App\ModelControllers\CoffeeController;

if ( ! function_exists('coffeeController')) {
	/*** @return CoffeeController */
	function coffeeController(): CoffeeController
	{
		return app('CoffeeController');
	}
}