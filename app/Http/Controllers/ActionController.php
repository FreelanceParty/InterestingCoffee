<?php

namespace App\Http\Controllers;

use App\Exceptions\CoffeeNotFoundException;
use App\Exceptions\DelicacyNotFoundException;
use App\Exceptions\QuestionNotFoundException;
use App\Exceptions\AdditionNotFoundException;
use App\Models\Abstracts\AProduct;
use App\ValuesObject\Constants\AdditionType;
use App\ValuesObject\Constants\ProductType;
use App\ValuesObject\ModelCreator;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use JsonException;

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
		ModelCreator::createFeedback($request->get('user_name'), $request->get('text'));
		return response()->json([
			'ack' => 'success',
		]);
	}

	/***
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function sendQuestion(Request $request): JsonResponse
	{
		ModelCreator::createQuestion($request->get('user_id'), $request->get('text'));
		return response()->json([
			'ack' => 'success',
		]);
	}

	/***
	 * @param Request $request
	 * @return JsonResponse
	 * @throws QuestionNotFoundException
	 */
	public function replyQuestion(Request $request): JsonResponse
	{
		$question = questionController()->findById($request->get('question_id'));
		$answer   = $request->get('answer');
		$question->setAnswer($answer);
		$question->save();
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
		$validator = Validator::make($request->all(), [
			'product_type' => 'required|in:' . implode(',', ProductType::ALL),
			'title'        => 'required|string|max:255',
			'price'        => 'required|numeric',
			'description'  => 'sometimes|nullable|string',
			'image'        => 'sometimes|nullable|image',
		]);
		if ($validator->fails()) {
			return response()->json(['ack' => "fail"]);
		}
		$productType = $request->get('product_type');
		$title       = $request->get('title');
		$price       = $request->get('price');
		$description = $request->get('description');
		$image       = $request->hasFile('image') ? Image::make($request->file('image')) : NULL;
		if ($productType === ProductType::ADDITION) {
			$additionValidator = Validator::make($request->all(), [
				'addition_type_id' => 'required|in:' . implode(',', AdditionType::ALL),
			]);
			if ($additionValidator->fails()) {
				return response()->json(['ack' => "fail"]);
			}
			$additionTypeId = $request->get('addition_type_id');
			ModelCreator::createAddition($additionTypeId, $title, $price, $description, $image);
		} else {
			ModelCreator::createProduct($productType, $title, $price, $description, $image);
		}
		return response()->json([
			'ack' => 'success',
		]);
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 * @throws CoffeeNotFoundException
	 * @throws DelicacyNotFoundException
	 * @throws AdditionNotFoundException
	 */
	public function updateProduct(Request $request): JsonResponse
	{
		$validator = Validator::make($request->all(), [
			'product_id'   => 'required',
			'product_type' => 'required|in:' . implode(',', ProductType::ALL),
			'title'        => 'required|string|max:255',
			'price'        => 'required|numeric',
			'description'  => 'sometimes|nullable|string',
			'image'        => 'sometimes|nullable|image',
		]);
		if ($validator->fails()) {
			return response()->json(['ack' => "fail"]);
		}
		$productId      = $request->get('product_id');
		$productType    = $request->get('product_type');
		$newTitle       = $request->get('title');
		$newPrice       = $request->get('price');
		$newDescription = $request->get('description');
		$imageChanged   = $request->has('image') || $request->hasFile('image');
		$newImage       = $request->hasFile('image') ? Image::make($request->file('image')) : NULL;
		$product        = ModelCreator::updateProduct($productId, $productType, $newTitle, $newPrice, $newDescription, $newImage, $imageChanged);
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
	 * @throws AdditionNotFoundException
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
		if ($productType === ProductType::ADDITION) {
			$product = additionController()->findById($productId);
		}
		$product->delete();
		return response()->json([
			'ack' => 'success',
		]);
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 * @throws JsonException
	 */
	public function createOrder(Request $request): JsonResponse
	{
		$dateTime      = Carbon::createFromTimeString($request->get('date_time'));
		$coffeesIds    = $request->get('coffees_ids', []);
		$additionsIds  = $request->get('additions_ids', []);
		$delicaciesIds = $request->get('delicacies_ids', []);
		$coffees       = coffeeController()->getTitlesArrayByIds($coffeesIds);
		$additions     = additionController()->getTitlesArrayByIds($additionsIds);
		$delicacies    = delicacyController()->getTitlesArrayByIds($delicaciesIds);
		ModelCreator::createOrder(
			$request->get('user_name'),
			$request->get('phone_number'),
			$request->get('seats_count'),
			$dateTime,
			$request->get('total_price'),
			array_merge($coffees, $additions, $delicacies),
		);
		return response()->json([
			'ack' => 'success',
		]);
	}
}
