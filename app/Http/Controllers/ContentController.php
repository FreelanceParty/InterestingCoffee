<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
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
				'coffees' => coffeeController()->getAll(),
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
				'delicacies' => delicacyController()->getAll(),
			])->render(),
		]);
	}

	/***
	 * @return JsonResponse
	 * @throws Throwable
	 */
	public function getSpicesView(): JsonResponse
	{
		return response()->json([
			'view' => view('content.product.spices', [
				'spices' => spiceController()->getAll(),
			])->render(),
		]);
	}

	/***
	 * @return JsonResponse
	 * @throws Throwable
	 */
	public function getHomeView(): JsonResponse
	{
		return response()->json([
			'view' => view('content.home._common', [
				'feedbacks' => feedbackController()->getAll()->take(4),
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
			'view' => view('content.statistics')->render(),
		]);
	}

	/***
	 * @return JsonResponse
	 * @throws Throwable
	 */
	public function getFeedbacksView(): JsonResponse
	{
		return response()->json([
			'view' => view('content.feedbacks', [
				'feedbacks' => feedbackController()->getAll(),
			])->render(),
		]);
	}
}
