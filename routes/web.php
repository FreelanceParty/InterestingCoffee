<?php

use App\Http\Controllers\ContentController;
use Illuminate\Support\Facades\Route;

Route::get('/', static function() {
	return view('welcome');
});
Route::post('/coffees', [ContentController::class, 'getCoffeeView'])->name('coffees');