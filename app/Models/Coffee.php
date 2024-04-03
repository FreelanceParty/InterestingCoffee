<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Coffee
 * @property int         $id
 * @property string      $title
 * @property float       $price
 * @property string|NULL $image
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 * @method static where($column, $operator, $value)
 * @package App\Models
 */
class Coffee extends Model
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

	/*** @return Carbon */
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
