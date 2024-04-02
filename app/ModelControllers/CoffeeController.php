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

	/**
	 * @param string $title
	 * @return Coffee
	 * @throws CoffeeNotFoundException
	 */
	public function findByTitle(string $title): Coffee
	{
		return $this->repo->findByTitle($title);
	}

	/*** @return Collection */
	public function getAll(): Collection
	{
		return $this->repo->getAll();
	}
}