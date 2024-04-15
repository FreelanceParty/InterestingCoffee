<?php

namespace App\ModelControllers\Repositories;

use App\Exceptions\AdditionNotFoundException;
use App\Models\Addition;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/***
 * Class AdditionRepository
 * @package App\ModelControllers\Repositories
 */
class AdditionRepository
{
	/***
	 * @param int $id
	 * @return Addition
	 * @throws AdditionNotFoundException
	 */
	public function findById(int $id): Addition
	{
		$addition = Addition::where('id', '=', $id)->first();
		if ($addition === NULL) {
			throw new AdditionNotFoundException;
		}
		return $addition;
	}

	/***
	 * @param int $addition_type_id
	 * @return Collection|Addition[]
	 * @throws AdditionNotFoundException
	 */
	public function getByTypeId(int $addition_type_id): array|Collection
	{
		return Addition::where('addition_type_id', '=', $addition_type_id)->get();
	}

	/*** @return Collection */
	public function getAll(): Collection
	{
		return Addition::all();
	}

	/**
	 * @param array $ids
	 * @return array
	 */
	public function getTitlesArrayByIds(array $ids): array
	{
		$additions = DB::table('additions')
			->select('id', 'title')
			->whereIn('id', $ids)
			->pluck('id', 'title')
			->toArray();
		$result = [];
		foreach ($additions as $key => $value) {
			$result[$key] = array_count_values($ids)[$value];
		}
		return $result;
	}
}