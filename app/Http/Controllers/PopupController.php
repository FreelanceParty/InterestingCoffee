<?php

namespace App\Http\Controllers;

use App\ValuesObject\InfoType;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

/**
 * Class PopupController
 * @package App\Http\Controllers
 */
class PopupController extends Controller
{
	/**
	 * @return JsonResponse
	 * @throws Throwable
	 */
	public function getLoginPopup(): JsonResponse
	{
		return response()->json([
			'headerText' => "Вхід",
			'html'       => view('popup.login')->render(),
		]);
	}

	/**
	 * @return JsonResponse
	 * @throws Throwable
	 */
	public function getRegisterPopup(): JsonResponse
	{
		return response()->json([
			'headerText' => "Реєстрація",
			'html'       => view('popup.register')->render(),
		]);
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 * @throws Throwable
	 */
	public function getInfoPopup(Request $request): JsonResponse
	{
		$infoType    = $request->get('info_type');
		$iconClasses = sprintf('%s fa-2xl', InfoType::ICON_CLASSES[$infoType]);
		return response()->json([
			'html' => view('popup.info', [
				'text'        => $request->get('text'),
				'iconClasses' => $iconClasses,
			])->render(),
		]);
	}
}
