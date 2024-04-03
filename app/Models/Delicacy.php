<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Delicacy
 * @property int         $id
 * @property string      $title
 * @property float       $price
 * @property string|NULL $Image
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 * @method static where($column, $operator, $value)
 * @package App\Models
 */
class Delicacy extends Model
{
	use HasFactory;

	/*** @return int */
	public function getId(): int
	{
		return $this->id;
	}

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

	/***@return Carbon */
	public function getCreatedAt(): Carbon
	{
		return $this->created_at;
	}

	/*** @return Carbon */
	public function getUpdatedAt(): Carbon
	{
		return $this->updated_at;
	}
}
