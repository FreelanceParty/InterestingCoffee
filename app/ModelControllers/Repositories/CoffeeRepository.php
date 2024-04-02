<?php

namespace App\ModelControllers\Repositories;

use App\Exceptions\CoffeeNotFoundException;
use App\Models\Coffee;
use Illuminate\Database\Eloquent\Collection;

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

	/**
	 * @param string $title
	 * @return Coffee
	 * @throws CoffeeNotFoundException
	 */
	public function findByTitle(string $title): Coffee
	{
		$coffee = Coffee::where('title', '=', $title)->first();
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
}