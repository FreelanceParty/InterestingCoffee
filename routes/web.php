<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\PopupController;
use Illuminate\Support\Facades\Route;

Route::get('/', static function() {
	return view('welcome');
});
Route::group(['prefix' => '/action'], static function() {
	Route::post('/send_feedback', [ActionController::class, 'sendFeedback'])->name('action.send-feedback');
});
Route::group(['prefix' => '/content'], static function() {
	Route::post('/coffees', [ContentController::class, 'getCoffeesView'])->name('content.coffees');
	Route::post('/delicacies', [ContentController::class, 'getDelicaciesView'])->name('content.delicacies');
	Route::post('/spices', [ContentController::class, 'getSpicesView'])->name('content.spices');
	Route::post('/home', [ContentController::class, 'getHomeView'])->name('content.home');
});
Route::group(['prefix' => '/popup'], static function() {
	Route::post('/info', [PopupController::class, 'getInfoPopup'])->name('popup.info');
	Route::post('/login', [PopupController::class, 'getLoginPopup'])->name('popup.login');
	Route::post('/register', [PopupController::class, 'getRegisterPopup'])->name('popup.register');
});
require __DIR__ . '/auth.php';