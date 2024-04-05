<?php

namespace App\Models;

use App\Models\Abstracts\AModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Delicacy
 * @property string      $title
 * @property float       $price
 * @property string|NULL $Image
 * @package App\Models
 */
class Delicacy extends AModel
{
	use HasFactory;

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

	/*** @return string|NULL */
	public function getImage(): ?string
	{
		return $this->Image;
	}

	/**
	 * @param string|NULL $Image
	 * @return void
	 */
	public function setImage(?string $Image): void
	{
		$this->Image = $Image;
	}

	/**
	 * @param float $price
	 * @return void
	 */
	public function setPrice(float $price): void
	{
		$this->price = $price;
	}
}
