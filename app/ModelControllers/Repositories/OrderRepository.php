<?php

namespace App\ModelControllers\Repositories;

use App\Exceptions\OrderNotFoundException;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class OrderRepository
 * @package App\ModelControllers\Repositories
 */
class OrderRepository
{
	/**
	 * @param int $id
	 * @return Order
	 * @throws OrderNotFoundException
	 */
	public function findById(int $id): Order
	{
		$order = Order::where('id', '=', $id)->first();
		if ($order === NULL) {
			throw new OrderNotFoundException();
		}
		return $order;
	}

	/*** @return Collection */
	public function getAll(): Collection
	{
		return Order::all();
	}
}