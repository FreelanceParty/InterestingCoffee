<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\PopupController;
use Illuminate\Support\Facades\Route;

Route::get('/', static function() {
	return view('welcome', [
		'feedbacks' => feedbackController()->getAll()->take(4),
	]);
});
Route::group(['prefix' => '/action'], static function() {
	Route::post('/send_feedback', [ActionController::class, 'sendFeedback'])->name('action.send-feedback');
	Route::post('/send_question', [ActionController::class, 'sendQuestion'])->name('action.send-question');
	Route::post('/reply_question', [ActionController::class, 'replyQuestion'])->middleware('isAdmin')->name('action.reply-question');
	Route::post('/create_order', [ActionController::class, 'createOrder'])->name('action.create-order');
	Route::group(['prefix' => '/product', 'middleware' => ['isAdmin']], static function() {
		Route::post('/add', [ActionController::class, 'addProduct'])->name('action.product.add');
		Route::post('/edit', [ActionController::class, 'updateProduct'])->name('action.product.edit');
		Route::post('/delete', [ActionController::class, 'deleteProduct'])->name('action.product.delete');
	});
});
Route::group(['prefix' => '/content'], static function() {
	Route::post('/coffees', [ContentController::class, 'getCoffeesView'])->name('content.coffees');
	Route::post('/delicacies', [ContentController::class, 'getDelicaciesView'])->name('content.delicacies');
	Route::post('/additions', [ContentController::class, 'getAdditionsView'])->name('content.additions');
	Route::post('/home', [ContentController::class, 'getHomeView'])->name('content.home');
	Route::post('/menu', [ContentController::class, 'getMenuView'])->name('content.menu');
	Route::post('/feedbacks', [ContentController::class, 'getFeedbacksView'])->name('content.feedbacks');
	Route::post('/questions', [ContentController::class, 'getQuestionsView'])->name('content.questions');
	Route::post('/orders', [ContentController::class, 'getOrdersView'])->middleware('isAdmin')->name('content.orders');
	Route::post('/statistics', [ContentController::class, 'getStatisticsView'])->middleware('isAdmin')->name('content.statistics');
});
Route::group(['prefix' => '/popup'], static function() {
	Route::post('/info', [PopupController::class, 'getInfoPopup'])->name('popup.info');
	Route::post('/login', [PopupController::class, 'getLoginPopup'])->name('popup.login');
	Route::post('/register', [PopupController::class, 'getRegisterPopup'])->name('popup.register');
	Route::post('/create_order', [PopupController::class, 'getCreateOrderPopup'])->name('popup.create-order');
	Route::group(['prefix' => '/product', 'middleware' => ['isAdmin']], static function() {
		Route::post('/add', [PopupController::class, 'getCreateProductPopup'])->name('popup.product.add');
		Route::post('/edit', [PopupController::class, 'getEditProductPopup'])->name('popup.product.edit');
		Route::post('/delete', [PopupController::class, 'getDeleteProductPopup'])->name('popup.product.delete');
	});
});
require __DIR__ . '/auth.php';