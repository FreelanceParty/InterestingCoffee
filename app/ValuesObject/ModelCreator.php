<?php

namespace App\ValuesObject;

use App\Models\Abstracts\AProduct;
use App\Models\Addition;
use App\Models\Coffee;
use App\Models\Delicacy;
use App\ValuesObject\Constants\ProductType;
use Intervention\Image\Image;

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
}