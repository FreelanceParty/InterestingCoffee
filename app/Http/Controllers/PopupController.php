<?php

namespace App\Http\Controllers;

use App\Exceptions\CoffeeNotFoundException;
use App\Exceptions\DelicacyNotFoundException;
use App\Exceptions\SpiceNotFoundException;
use App\Models\Abstracts\AProduct;
use App\ValuesObject\InfoType;
use App\ValuesObject\ProductType;
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

	public function getEditProductPopup()
	{
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 * @throws Throwable
	 * @throws CoffeeNotFoundException
	 * @throws DelicacyNotFoundException
	 * @throws SpiceNotFoundException
	 */
	public function getDeleteProductPopup(Request $request): JsonResponse
	{
		$productId   = $request->get('product_id');
		$productType = $request->get('product_type');
		/*** @var AProduct $product */
		if ($productType === ProductType::COFFEE) {
			$product = coffeeController()->findById($productId);
		}
		if ($productType === ProductType::DELICACY) {
			$product = delicacyController()->findById($productId);
		}
		if ($productType === ProductType::SPICE) {
			$product = spiceController()->findById($productId);
		}
		return response()->json([
			'html' => view('popup.product.delete', [
				'id'          => $productId,
				'productType' => $productType,
				'productName' => $product->getTitle(),
			])->render(),
		]);
	}
}
