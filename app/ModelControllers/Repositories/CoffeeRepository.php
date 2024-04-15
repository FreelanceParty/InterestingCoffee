<?php

namespace App\ModelControllers\Repositories;

use App\Exceptions\CoffeeNotFoundException;
use App\Models\Coffee;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class CoffeeRepository
 * @package App\ModelControllers\Repositories
 */
class CoffeeRepository
{
	/**
	 * @param int $id
	 * @return Coffee
	 * @throws CoffeeNotFoundException
	 */
	public function findById(int $id): Coffee
	{
		$coffee = Coffee::where('id', '=', $id)->first();
		if ($coffee === NULL) {
			throw new CoffeeNotFoundException;
		}
		return $coffee;
	}

	/*** @return Collection */
	public function getAll(): Collection
	{
		return Coffee::all();
	}

	/**
	 * @param array $ids
	 * @return array
	 */
	public function getTitlesArrayByIds(array $ids): array
	{
		$coffees = DB::table('coffees')
			->select('id', 'title')
			->whereIn('id', $ids)
			->pluck('id', 'title')
			->toArray();
		$result  = [];
		foreach ($coffees as $key => $value) {
			$result[$key] = array_count_values($ids)[$value];
		}
		return $result;
	}
}