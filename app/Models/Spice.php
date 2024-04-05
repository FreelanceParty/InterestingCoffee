<?php

namespace App\Models;

use App\Models\Abstracts\AModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Spice
 * @property string      $title
 * @property float       $price
 * @property string|NULL $image
 * @package App\Models
 */
class Spice extends AModel
{
	use HasFactory;

	/****@return string */
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
