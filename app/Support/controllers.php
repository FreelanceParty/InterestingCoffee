<?php

use App\ModelControllers\CoffeeController;
use App\ModelControllers\DelicacyController;
use App\ModelControllers\FeedbackController;
use App\ModelControllers\QuestionController;
use App\ModelControllers\AdditionController;
use App\ModelControllers\UserController;

if ( ! function_exists('coffeeController')) {
	/*** @return CoffeeController */
	function coffeeController(): CoffeeController
	{
		return app('CoffeeController');
	}
}
if ( ! function_exists('additionController')) {
	/*** @return AdditionController */
	function additionController(): AdditionController
	{
		return app('AdditionController');
	}
}
if ( ! function_exists('delicacyController')) {
	/*** @return DelicacyController */
	function delicacyController(): DelicacyController
	{
		return app('DelicacyController');
	}
}
if ( ! function_exists('userController')) {
	/*** @return UserController */
	function userController(): UserController
	{
		return app('UserController');
	}
}
if ( ! function_exists('feedbackController')) {
	/*** @return FeedbackController */
	function feedbackController(): FeedbackController
	{
		return app('FeedbackController');
	}
}
if ( ! function_exists('questionController')) {
	/*** @return QuestionController */
	function questionController(): QuestionController
	{
		return app('QuestionController');
	}
}