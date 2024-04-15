<?php

namespace App\Models;

use App\Models\Abstracts\AModel;
use Carbon\Carbon;
use JsonException;

/**
 * Class Order
 * @property string      $user_name
 * @property string      $phone_number
 * @property int         $seats_count
 * @property Carbon      $date_time
 * @property string|NULL $products
 * @property float       $total_price
 * @package App\Models
 */
class Order extends AModel
{
	/*** @var string[] */
	protected array $dates = ['created_at', 'updated_at', 'date_time'];

	/*** @var array */
	public const SEATS_COUNT_PRICE = [
		1 => 100,
		2 => 190,
		3 => 270,
		4 => 340,
		5 => 400,
		6 => 450,
	];

	/*** @return string */
	public function getUserName(): string
	{
		return $this->user_name;
	}

	/**
	 * @param string $userName
	 * @return void
	 */
	public function setUserName(string $userName): void
	{
		$this->user_name = $userName;
	}

	/*** @return string */
	public function getPhoneNumber(): string
	{
		return $this->phone_number;
	}

	/**
	 * @param string $phoneNumber
	 * @return void
	 */
	public function setPhoneNumber(string $phoneNumber): void
	{
		$this->phone_number = $phoneNumber;
	}

	/*** @return int */
	public function getSeatsCount(): int
	{
		return $this->seats_count;
	}

	/**
	 * @param int $seatsCount
	 * @return void
	 */
	public function setSeatsCount(int $seatsCount): void
	{
		$this->seats_count = $seatsCount;
	}

	/*** @return Carbon */
	public function getDateTime(): Carbon
	{
		return Carbon::parse($this->date_time);
	}

	/**
	 * @param Carbon $dateTime
	 * @return void
	 */
	public function setDateTime(Carbon $dateTime): void
	{
		$this->date_time = $dateTime;
	}

	/**
	 * @return array|NULL
	 * @throws JsonException
	 */
	public function getProductsList(): ?array
	{
		return json_decode($this->products_list, TRUE, 512, JSON_THROW_ON_ERROR);
	}

	/**
	 * @param array|NULL $productsList
	 * @return void
	 * @throws JsonException
	 */
	public function setProductsList(?array $productsList): void
	{
		$this->products_list = json_encode($productsList, JSON_THROW_ON_ERROR);
	}

	/*** @return float */
	public function getTotalPrice(): float
	{
		return $this->total_price;
	}

	/**
	 * @param float $totalPrice
	 * @return void
	 */
	public function setTotalPrice(float $totalPrice): void
	{
		$this->total_price = $totalPrice;
	}
}
