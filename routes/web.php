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
	Route::group(['prefix' => '/feedback'], static function() {
		Route::post('/edit', [ActionController::class, 'editFeedback'])->name('action.feedback.edit');
		Route::post('/delete', [ActionController::class, 'deleteFeedback'])->middleware('isAdmin')->name('action.feedback.delete');
		Route::post('/send', [ActionController::class, 'sendFeedback'])->name('action.feedback.send');
	});
	Route::group(['prefix' => '/order'], static function() {
		Route::post('/create', [ActionController::class, 'createOrder'])->name('action.order.create');
		Route::post('/delete', [ActionController::class, 'deleteOrder'])->middleware('isAdmin')->name('action.order.delete');
	});
	Route::group(['prefix' => '/product', 'middleware' => ['isAdmin']], static function() {
		Route::post('/add', [ActionController::class, 'addProduct'])->name('action.product.add');
		Route::post('/edit', [ActionController::class, 'updateProduct'])->name('action.product.edit');
		Route::post('/delete', [ActionController::class, 'deleteProduct'])->name('action.product.delete');
	});
	Route::group(['prefix' => '/question'], static function() {
		Route::post('/reply', [ActionController::class, 'replyQuestion'])->middleware('isAdmin')->name('action.question.reply');
		Route::group(['middleware' => ['isNotAdmin']], static function() {
			Route::post('/send', [ActionController::class, 'sendQuestion'])->name('action.question.send');
			Route::post('/edit', [ActionController::class, 'editQuestion'])->name('action.question.edit');
			Route::post('/delete', [ActionController::class, 'deleteQuestion'])->name('action.question.delete');
		});
	});
});
Route::group(['prefix' => '/content'], static function() {
	Route::post('/additions', [ContentController::class, 'getAdditionsView'])->name('content.additions');
	Route::post('/coffees', [ContentController::class, 'getCoffeesView'])->name('content.coffees');
	Route::post('/delicacies', [ContentController::class, 'getDelicaciesView'])->name('content.delicacies');
	Route::post('/feedbacks', [ContentController::class, 'getFeedbacksView'])->name('content.feedbacks');
	Route::post('/home', [ContentController::class, 'getHomeView'])->name('content.home');
	Route::post('/menu', [ContentController::class, 'getMenuView'])->name('content.menu');
	Route::post('/questions', [ContentController::class, 'getQuestionsView'])->name('content.questions');
	Route::group(['middleware' => ['isAdmin']], static function() {
		Route::post('/orders', [ContentController::class, 'getOrdersView'])->name('content.orders');
		Route::post('/statistics', [ContentController::class, 'getStatisticsView'])->name('content.statistics');
	});
});
Route::group(['prefix' => '/popup'], static function() {
	Route::post('/info', [PopupController::class, 'getInfoPopup'])->name('popup.info');
	Route::post('/login', [PopupController::class, 'getLoginPopup'])->name('popup.login');
	Route::post('/register', [PopupController::class, 'getRegisterPopup'])->name('popup.register');
	Route::group(['prefix' => '/order'], static function() {
		Route::post('/create', [PopupController::class, 'getCreateOrderPopup'])->middleware('auth')->name('popup.order.create');
		Route::post('/delete', [PopupController::class, 'getDeleteOrderPopup'])->middleware('isAdmin')->name('popup.order.delete');
	});
	Route::group(['prefix' => '/feedback'], static function() {
		Route::post('/delete', [PopupController::class, 'getDeleteFeedbackPopup'])->middleware('isAdmin')->name('popup.feedback.delete');
		Route::post('/edit', [PopupController::class, 'getEditFeedbackPopup'])->name('popup.feedback.edit');
	});
	Route::group(['prefix' => '/product', 'middleware' => ['isAdmin']], static function() {
		Route::post('/add', [PopupController::class, 'getCreateProductPopup'])->name('popup.product.add');
		Route::post('/delete', [PopupController::class, 'getDeleteProductPopup'])->name('popup.product.delete');
		Route::post('/edit', [PopupController::class, 'getEditProductPopup'])->name('popup.product.edit');
	});
	Route::group(['prefix' => '/question', 'middleware' => ['isNotAdmin']], static function() {
		Route::post('/delete', [PopupController::class, 'getDeleteQuestionPopup'])->name('popup.question.delete');
		Route::post('/edit', [PopupController::class, 'getEditQuestionPopup'])->name('popup.question.edit');
	});
});
require __DIR__ . '/auth.php';