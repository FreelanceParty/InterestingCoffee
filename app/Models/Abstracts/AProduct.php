<?php

namespace App\Models\Abstracts;

use App\ValuesObject\Constants\ProductType;

/**
 * Class Coffee
 * @property string      $title
 * @property float       $price
 * @property string|NULL $description
 * @property string|NULL $image
 * @package App\Models
 */
class AProduct extends AModel
{
	/*** @var string */
	public const PRODUCT_TYPE = ProductType::UNDEFINED;

	/*** @return string */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 * @return void
	 */
	public function setTitle(string $title): void
	{
		$this->title = $title;
	}

	/*** @return float */
	public function getPrice(): float
	{
		return $this->price;
	}

	/**
	 * @param float $price
	 * @return void
	 */
	public function setPrice(float $price): void
	{
		$this->price = $price;
	}

	/*** @return string|NULL */
	public function getDescription(): ?string
	{
		return $this->description;
	}

	/**
	 * @param string|NULL $description
	 * @return void
	 */
	public function setDescription(?string $description): void
	{
		$this->description = $description;
	}

	/*** @return string|NULL */
	public function getImage(): ?string
	{
		return $this->image;
	}

	/**
	 * @param string|NULL $image
	 * @return void
	 */
	public function setImage(?string $image): void
	{
		$this->image = $image;
	}
}
