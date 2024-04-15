<?php

namespace App\ValuesObject;

use App\Exceptions\AdditionNotFoundException;
use App\Exceptions\CoffeeNotFoundException;
use App\Exceptions\DelicacyNotFoundException;
use App\Models\Abstracts\AProduct;
use App\Models\Addition;
use App\Models\Coffee;
use App\Models\Delicacy;
use App\Models\Order;
use App\ValuesObject\Constants\ProductType;
use Carbon\Carbon;
use Intervention\Image\Image;
use JsonException;

/**
 * Class ModelCreator
 * @package App\ValuesObject
 */
class ModelCreator
{
	/**
	 * @param string      $productType
	 * @param string      $title
	 * @param float       $price
	 * @param string|NULL $description
	 * @param Image|NULL  $image
	 * @return AProduct
	 */
	public static function createProduct(string $productType, string $title, float $price, ?string $description = NULL, ?Image $image = NULL): AProduct
	{
		/*** @var AProduct $product */
		if ($productType === ProductType::COFFEE) {
			$product = new Coffee();
		}
		if ($productType === ProductType::DELICACY) {
			$product = new Delicacy();
		}
		if ($productType === ProductType::ADDITION) {
			$product = new Addition();
		}
		$product->setTitle($title);
		$product->setPrice($price);
		$product->setDescription($description);
		if ($image !== NULL) {
			$product->setImage($image->encode('data-url', 80)->encoded);
		}
		$product->save();
		return $product;
	}

	/**
	 * @param int         $additionTypeId
	 * @param string      $title
	 * @param float       $price
	 * @param string|NULL $description
	 * @param Image|NULL  $image
	 * @return Addition
	 */
	public static function createAddition(int $additionTypeId, string $title, float $price, ?string $description = NULL, ?Image $image = NULL): Addition
	{
		/*** @var Addition $addition */
		$addition = self::createProduct(ProductType::ADDITION, $title, $price, $description, $image);
		$addition->setAdditionTypeId($additionTypeId);
		$addition->save();
		return $addition;
	}

	/**
	 * @param string      $productId
	 * @param string      $productType
	 * @param string      $title
	 * @param float       $price
	 * @param string|NULL $description
	 * @param Image|NULL  $image
	 * @param bool        $imageChanged
	 * @return AProduct
	 * @throws AdditionNotFoundException
	 * @throws CoffeeNotFoundException
	 * @throws DelicacyNotFoundException
	 */
	public static function updateProduct(string $productId, string $productType, string $title, float $price, ?string $description = NULL, ?Image $image = NULL, bool $imageChanged = TRUE): AProduct
	{
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
		$product->setTitle($title);
		$product->setPrice($price);
		$product->setDescription($description);
		if ($imageChanged) {
			$product->setImage($image?->encode('data-url', 80)->encoded);
		}
		return $product;
	}

	/**
	 * @param string     $userName
	 * @param string     $phoneNumber
	 * @param int        $seatsCount
	 * @param Carbon     $dateTime
	 * @param float      $totalPrice
	 * @param array|NULL $productsList
	 * @return Order
	 * @throws JsonException
	 */
	public static function createOrder(string $userName, string $phoneNumber, int $seatsCount, Carbon $dateTime, float $totalPrice, ?array $productsList = NULL): Order
	{
		$order = new Order();
		$order->setUserName($userName);
		$order->setPhoneNumber($phoneNumber);
		$order->setSeatsCount($seatsCount);
		$order->setDateTime($dateTime);
		$order->setTotalPrice($totalPrice);
		$order->setProductsList($productsList);
		$order->save();
		return $order;
	}
}