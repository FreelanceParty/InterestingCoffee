<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Class ContentController
 * @package App\Http\Controllers
 */
class ContentController extends Controller
{
	/*** @return JsonResponse */
	public function getCoffeesView(): JsonResponse
	{
		return response()->json([
			'view' => view('tabs.coffees', [
				'coffees' => coffeeController()->getAll(),
			])->render(),
		]);
	}

	/*** @return JsonResponse */
	public function getDelicaciesView(): JsonResponse
	{
		return response()->json([
			'view' => view('tabs.delicacies', [
				'delicacies' => delicacyController()->getAll(),
			])->render(),
		]);
	}

	/*** @return JsonResponse */
	public function getSpicesView(): JsonResponse
	{
		return response()->json([
			'view' => view('tabs.spices', [
				'spices' => spiceController()->getAll(),
			])->render(),
		]);
	}

	/*** @return JsonResponse */
	public function getHomeView(): JsonResponse
	{
		return response()->json([
			'view' => view('tabs.home')->render(),
		]);
	}
}
