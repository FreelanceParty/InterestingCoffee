<?php

use App\ModelControllers\CoffeeController;
use App\ModelControllers\DelicacyController;
use App\ModelControllers\SpiceController;

if ( ! function_exists('coffeeController')) {
	/*** @return CoffeeController */
	function coffeeController(): CoffeeController
	{
		return app('CoffeeController');
	}
}
if ( ! function_exists('spiceController')) {
	/*** @return SpiceController */
	function spiceController(): SpiceController
	{
		return app('SpiceController');
	}
}
if ( ! function_exists('delicacyController')) {
	/*** @return DelicacyController */
	function delicacyController(): DelicacyController
	{
		return app('DelicacyController');
	}
}