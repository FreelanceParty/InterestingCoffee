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
	public function getCoffeeView(): JsonResponse
	{
		return response()->json([
			'view' => view('tabs.coffees', [
				'coffees' => coffeeController()->getAll(),
			])->render(),
		]);
	}
}
