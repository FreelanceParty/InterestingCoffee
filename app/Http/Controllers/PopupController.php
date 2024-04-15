<?php

namespace App\Http\Controllers;

use App\Exceptions\CoffeeNotFoundException;
use App\Exceptions\DelicacyNotFoundException;
use App\Exceptions\AdditionNotFoundException;
use App\Models\Abstracts\AProduct;
use App\ValuesObject\Constants\InfoType;
use App\ValuesObject\Constants\ProductType;
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

	/**
	 * @param Request $request
	 * @return JsonResponse
	 * @throws Throwable
	 * @throws CoffeeNotFoundException
	 * @throws DelicacyNotFoundException
	 * @throws AdditionNotFoundException
	 */
	public function getEditProductPopup(Request $request): JsonResponse
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
		if ($productType === ProductType::ADDITION) {
			$product = additionController()->findById($productId);
		}
		return response()->json([
			'headerText' => "Оновлення продукту",
			'html'       => view('popup.product.edit', [
				'product' => $product,
			])->render(),
		]);
	}

	/**
	 * @return JsonResponse
	 * @throws Throwable
	 */
	public function getCreateProductPopup(): JsonResponse
	{
		return response()->json([
			'headerText' => "Додавання продукту",
			'html'       => view('popup.product.add')->render(),
		]);
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 * @throws Throwable
	 * @throws CoffeeNotFoundException
	 * @throws DelicacyNotFoundException
	 * @throws AdditionNotFoundException
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
		if ($productType === ProductType::ADDITION) {
			$product = additionController()->findById($productId);
		}
		return response()->json([
			'headerText' => "Видалення продукту",
			'html'       => view('popup.product.delete', [
				'id'          => $productId,
				'productType' => $productType,
				'productName' => $product->getTitle(),
			])->render(),
		]);
	}

	/**
	 * @return JsonResponse
	 * @throws Throwable
	 */
	public function getCreateOrderPopup(): JsonResponse
	{
		return response()->json([
			'headerText' => "Замовлення столика",
			'html'       => view('popup.create_order')->render(),
		]);
	}
}
