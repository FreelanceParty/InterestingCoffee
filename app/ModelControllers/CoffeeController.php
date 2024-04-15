<?php

namespace App\ModelControllers;

use App\Exceptions\CoffeeNotFoundException;
use App\ModelControllers\Repositories\CoffeeRepository;
use App\Models\Coffee;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CoffeeController
 * @package App\ModelControllers
 */
class CoffeeController
{
	/*** @var CoffeeRepository */
	private CoffeeRepository $repo;

	/*** @return void */
	public function __construct()
	{
		$this->repo = new CoffeeRepository();
	}

	/**
	 * @param int $id
	 * @return Coffee
	 * @throws CoffeeNotFoundException
	 */
	public function findById(int $id): Coffee
	{
		return $this->repo->findById($id);
	}

	/*** @return Collection */
	public function getAll(): Collection
	{
		return $this->repo->getAll();
	}

	/**
	 * @param array $ids
	 * @return array
	 */
	public function getTitlesArrayByIds(array $ids): array
	{
		return $this->repo->getTitlesArrayByIds($ids);
	}
}