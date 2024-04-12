<?php

namespace App\Http\Controllers;

use App\Exceptions\CoffeeNotFoundException;
use App\Exceptions\DelicacyNotFoundException;
use App\Exceptions\QuestionNotFoundException;
use App\Exceptions\AdditionNotFoundException;
use App\Exceptions\UserNotFoundException;
use App\Models\Abstracts\AProduct;
use App\Models\Addition;
use App\Models\Coffee;
use App\Models\Delicacy;
use App\Models\Feedback;
use App\Models\Question;
use App\ValuesObject\Constants\ProductType;
use App\ValuesObject\ModelCreator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

	/***
	 * @param Request $request
	 * @return JsonResponse
	 * @throws UserNotFoundException
	 */
	public function sendQuestion(Request $request): JsonResponse
	{
		$user     = userController()->findById($request->get('user_id'));
		$text     = $request->get('text');
		$question = new Question();
		$question->setUserId($user->getId());
		$question->setText($text);
		$question->save();
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
			'description'  => 'nullable|string',
			'image'        => 'nullable|image',
		]);
		if ($validator->fails()) {
			return response()->json([
				'ack'    => "fail",
				'errors' => $validator->errors(),
			]);
		}
		$productType = $request->get('product_type');
		$title       = $request->get('title');
		$price       = $request->get('price');
		$description = $request->get('description');
		$image       = NULL;
		if ($request->hasFile('image')) {
			$image = Image::make($request->file('image'));
		}
		ModelCreator::createProduct($productType, $title, $price, $description, $image);
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
			'description'  => 'nullable|string',
			'image'        => 'nullable|image',
		]);
		if ($validator->fails()) {
			return response()->json([
				'ack'    => "fail",
				'errors' => $validator->errors(),
			]);
		}
		$productId      = $request->get('product_id');
		$productType    = $request->get('product_type');
		$newTitle       = $request->get('title');
		$newPrice       = $request->get('price');
		$newDescription = $request->get('description');
		$newImage       = NULL;
		if ($request->hasFile('image')) {
			$newImage = Image::make($request->file('image'));
		}
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
		$product->setTitle($newTitle);
		$product->setPrice($newPrice);
		$product->setDescription($newDescription);
		if ($newImage != NULL) {
			$product->setImage($newImage->encode('data-url', 80)->encoded);
		}
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
}
