<?php

namespace App\ModelControllers;

use App\Exceptions\StatisticNotFoundException;
use App\ModelControllers\Repositories\StatisticRepository;
use App\Models\Statistic;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class StatisticController
 * @package App\ModelControllers
 */
class StatisticController
{
	/*** @var StatisticRepository */
	private StatisticRepository $repo;

	/*** @return void */
	public function __construct()
	{
		$this->repo = new StatisticRepository();
	}

	/**
	 * @param int $id
	 * @return Statistic
	 * @throws StatisticNotFoundException
	 */
	public function findById(int $id): Statistic
	{
		return $this->repo->findById($id);
	}

	/**
	 * @param string $category
	 * @return Statistic
	 * @throws StatisticNotFoundException
	 */
	public function findByCategory(string $category): Statistic
	{
		return $this->repo->findByCategory($category);
	}

	/*** @return Collection */
	public function getAll(): Collection
	{
		return $this->repo->getAll();
	}
}