<?php

namespace App\ModelControllers;

use App\Exceptions\OrderNotFoundException;
use App\ModelControllers\Repositories\OrderRepository;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class OrderController
 * @package App\ModelControllers
 */
class OrderController
{
	/*** @var OrderRepository */
	private OrderRepository $repo;

	/*** @return void */
	public function __construct()
	{
		$this->repo = new OrderRepository();
	}

	/**
	 * @param int $id
	 * @return Order
	 * @throws OrderNotFoundException
	 */
	public function findById(int $id): Order
	{
		return $this->repo->findById($id);
	}

	/*** @return Collection */
	public function getAll(): Collection
	{
		return $this->repo->getAll();
	}
}