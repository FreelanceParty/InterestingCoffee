<?php

use App\Http\Controllers\ContentController;
use Illuminate\Support\Facades\Route;

Route::get('/', static function() {
	return view('welcome');
});
Route::post('/coffees', [ContentController::class, 'getCoffeesView'])->name('coffees');
Route::post('/delicacies', [ContentController::class, 'getDelicaciesView'])->name('delicacies');
Route::post('/spices', [ContentController::class, 'getSpicesView'])->name('spices');
Route::post('/home', [ContentController::class, 'getHomeView'])->name('home');
require __DIR__ . '/auth.php';