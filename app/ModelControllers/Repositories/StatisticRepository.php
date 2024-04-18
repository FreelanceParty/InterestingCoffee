<?php

namespace App\ModelControllers\Repositories;

use App\Exceptions\StatisticNotFoundException;
use App\Models\Statistic;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class StatisticRepository
 * @package App\ModelControllers\Repositories
 */
class StatisticRepository
{
	/**
	 * @param int $id
	 * @return Statistic
	 * @throws StatisticNotFoundException
	 */
	public function findById(int $id): Statistic
	{
		$statistic = Statistic::where('id', '=', $id)->first();
		if ($statistic === NULL) {
			throw new StatisticNotFoundException;
		}
		return $statistic;
	}

	/**
	 * @param string $category
	 * @return Statistic
	 * @throws StatisticNotFoundException
	 */
	public function findByCategory(string $category): Statistic
	{
		$statistic = Statistic::where('category', '=', $category)->first();
		if ($statistic === NULL) {
			throw new StatisticNotFoundException;
		}
		return $statistic;
	}

	/*** @return Collection */
	public function getAll(): Collection
	{
		return Statistic::all();
	}
}