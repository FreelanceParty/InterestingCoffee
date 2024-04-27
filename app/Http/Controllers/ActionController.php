<?php

namespace App\Http\Controllers;

use App\Exceptions\CoffeeNotFoundException;
use App\Exceptions\DelicacyNotFoundException;
use App\Exceptions\FeedbackNotFoundException;
use App\Exceptions\OrderNotFoundException;
use App\Exceptions\QuestionNotFoundException;
use App\Exceptions\AdditionNotFoundException;
use App\Exceptions\StatisticNotFoundException;
use App\Models\Abstracts\AProduct;
use App\Models\User;
use App\ValuesObject\Constants\AdditionType;
use App\ValuesObject\Constants\ProductType;
use App\ValuesObject\Constants\StatisticCategories;
use App\ValuesObject\ModelCreator;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
		/*** @var User $authUser */
		$authUser = Auth::user();
		if ($authUser === NULL) {
			$userName = $request->get('user_name');
		} else {
			$userName = $authUser->getEmail();
			$userId   = $authUser->getId();
		}
		ModelCreator::createFeedback($userName, $request->get('text'), $userId ?? NULL);
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
	 * @throws OrderNotFoundException
	 */
	public function deleteOrder(Request $request): JsonResponse
	{
		$order = orderController()->findById($request->get('order_id'));
		$order->delete();
		return response()->json([
			'ack' => 'success',
		]);
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 * @throws FeedbackNotFoundException
	 */
	public function deleteFeedback(Request $request): JsonResponse
	{
		$feedback = feedbackController()->findById($request->get('feedback_id'));
		$feedback->delete();
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
		$validator = Validator::make($request->all(), [
			'user_name'    => 'required|max:40',
			'phone_number' => 'required|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im',
			'seats_count'  => 'required|max:1',
			'date_time'    => 'required',
			'total_price'  => 'required|numeric',
		]);
		if ($validator->fails()) {
			return response()->json(['ack' => "fail"]);
		}
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
		try {
			statisticController()->findByCategory(StatisticCategories::COFFEES)->updateValues($coffees);
			statisticController()->findByCategory(StatisticCategories::ADDITIONS)->updateValues($additions);
			statisticController()->findByCategory(StatisticCategories::DELICACIES)->updateValues($delicacies);
			statisticController()->findByCategory(StatisticCategories::SEATS)->updateValueByKey($request->get('seats_count'), 1);
		} catch (StatisticNotFoundException) {
		}
		return response()->json([
			'ack' => 'success',
		]);
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 * @throws QuestionNotFoundException
	 */
	public function editQuestion(Request $request): JsonResponse
	{
		$validator = Validator::make($request->all(), [
			'id'   => 'required',
			'text' => 'required',
		]);
		if ($validator->fails()) {
			return response()->json(['ack' => "fail"]);
		}
		$questionId   = $request->get('id');
		$questionText = $request->get('text');
		ModelCreator::updateQuestion($questionId, $questionText);
		return response()->json([
			'ack' => 'success',
		]);
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 * @throws FeedbackNotFoundException
	 */
	public function editFeedback(Request $request): JsonResponse
	{
		$validator = Validator::make($request->all(), [
			'id'   => 'required',
			'text' => 'required',
		]);
		if ($validator->fails()) {
			return response()->json(['ack' => "fail"]);
		}
		$feedbackId   = $request->get('id');
		$feedbackText = $request->get('text');
		ModelCreator::updateFeedback($feedbackId, $feedbackText);
		return response()->json([
			'ack' => 'success',
		]);
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 * @throws QuestionNotFoundException
	 */
	public function deleteQuestion(Request $request): JsonResponse
	{
		$question_id = $request->get('question_id');
		$question    = questionController()->findById($question_id);
		$question->delete();
		return response()->json([
			'ack' => 'success',
		]);
	}
}
