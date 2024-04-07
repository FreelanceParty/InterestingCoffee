<?php

namespace App\Http\Controllers;

use App\Exceptions\CoffeeNotFoundException;
use App\Exceptions\DelicacyNotFoundException;
use App\Exceptions\SpiceNotFoundException;
use App\Models\Abstracts\AProduct;
use App\Models\Coffee;
use App\Models\Delicacy;
use App\Models\Feedback;
use App\Models\Spice;
use App\ValuesObject\ProductType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function addProduct(Request $request): JsonResponse
	{
		$productType = $request->get('product_type');
		$title    = $request->get('title');
		$price    = $request->get('price');
		$image = Image::make($request->file('image'));
		/*** @var AProduct $product */
		if ($productType === ProductType::COFFEE) {
			$product = new Coffee();
		}
		if ($productType === ProductType::DELICACY) {
			$product = new Delicacy();
		}
		if ($productType === ProductType::SPICE) {
			$product = new Spice();
		}
		$product->setTitle($title);
		$product->setPrice($price);
		$product->setImage($image->encode('data-url', 80)->encoded);
		$product->save();
		return response()->json([
			'ack' => 'success',
		]);
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 * @throws CoffeeNotFoundException
	 * @throws DelicacyNotFoundException
	 * @throws SpiceNotFoundException
	 */
	public function updateProduct(Request $request): JsonResponse
	{
		$productId   = $request->get('product_id');
		$productType = $request->get('product_type');
		$newTitle    = $request->get('title');
		$newPrice    = $request->get('price');
		$newImage = Image::make($request->file('image'));
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
		$product->setTitle($newTitle);
		$product->setPrice($newPrice);
		$product->setImage($newImage->encode('data-url', 80)->encoded);
		$product->save();
		return response()->json([
			'ack' => 'success',
		]);
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 * @throws CoffeeNotFoundException
	 * @throws DelicacyNotFoundException
	 * @throws SpiceNotFoundException
	 */
	public function deleteProduct(Request $request): JsonResponse
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
		$product->delete();
		return response()->json([
			'ack' => 'success',
		]);
	}
}
