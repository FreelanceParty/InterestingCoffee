<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

/**
 * Class ContentController
 * @package App\Http\Controllers
 */
class ContentController extends Controller
{
	/***
	 * @return JsonResponse
	 * @throws Throwable
	 */
	public function getCoffeesView(): JsonResponse
	{
		return response()->json([
			'view' => view('content.product.coffees', [
				'coffees' => coffeeController()->getAll()->take(30),
			])->render(),
		]);
	}

	/***
	 * @return JsonResponse
	 * @throws Throwable
	 */
	public function getDelicaciesView(): JsonResponse
	{
		return response()->json([
			'view' => view('content.product.delicacies', [
				'delicacies' => delicacyController()->getAll()->take(30),
			])->render(),
		]);
	}

	/***
	 * @return JsonResponse
	 * @throws Throwable
	 */
	public function getAdditionsView(): JsonResponse
	{
		return response()->json([
			'view' => view('content.product.additions', [
				'additions' => additionController()->getAll()->take(30),
			])->render(),
		]);
	}

	/***
	 * @return JsonResponse
	 * @throws Throwable
	 */
	public function getHomeView(): JsonResponse
	{
		/*** @var User $authUser */
		$authUser = Auth::user();
		return response()->json([
			'view' => view('content.home._common', [
				'authUser'  => $authUser,
				'feedbacks' => feedbackController()->getAll()->take(4),
			])->render(),
		]);
	}

	/***
	 * @return JsonResponse
	 * @throws Throwable
	 */
	public function getMenuView(): JsonResponse
	{
		return response()->json([
			'view' => view('content.menu._common', [
				'coffees'    => coffeeController()->getAll()->take(3),
				'additions'  => additionController()->getAll()->take(3),
				'delicacies' => delicacyController()->getAll()->take(3),
			])->render(),
		]);
	}

	/***
	 * @return JsonResponse
	 * @throws Throwable
	 */
	public function getStatisticsView(): JsonResponse
	{
		return response()->json([
			'view' => view('content.statistics._common')->render(),
		]);
	}

	/***
	 * @return JsonResponse
	 * @throws Throwable
	 */
	public function getFeedbacksView(): JsonResponse
	{
		/*** @var User $authUser */
		$authUser = Auth::user();
		return response()->json([
			'view' => view('content.feedbacks._common', [
				'authUser'  => $authUser,
				'feedbacks' => feedbackController()->getAll()->take(30),
			])->render(),
		]);
	}

	/***
	 * @return JsonResponse
	 * @throws Throwable
	 */
	public function getQuestionsView(): JsonResponse
	{
		/*** @var User $authUser */
		$authUser = Auth::user();
		if ($authUser->isAdmin()) {
			$questions = questionController()->getAllWithoutAnswer();
		} else {
			$questions = questionController()->getAllForUser($authUser->getId());
		}
		return response()->json([
			'view' => view('content.questions._common', [
				'authUser'  => $authUser,
				'questions' => $questions,
			])->render(),
		]);
	}

	/***
	 * @return JsonResponse
	 * @throws Throwable
	 */
	public function getOrdersView(): JsonResponse
	{
		/*** @var User $authUser */
		$authUser = Auth::user();
		return response()->json([
			'view' => view('content.orders._common', [
				'authUser' => $authUser,
				'orders'   => orderController()->getActual(),
			])->render(),
		]);
	}
}
