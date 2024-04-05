<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class ActionController
 * @package App\Http\Controllers
 */
class ActionController extends Controller
{
	/***
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function sendFeedback(Request $request): JsonResponse
	{
		$userName = $request->get('user_name');
		$text     = $request->get('text');
		$feedback = new Feedback();
		$feedback->setUserName($userName);
		$feedback->setText($text);
		$feedback->save();
		return response()->json([
			'ack' => 'success',
		]);
	}
}
