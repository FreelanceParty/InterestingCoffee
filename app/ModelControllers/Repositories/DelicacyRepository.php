<?php

namespace App\ModelControllers\Repositories;

use App\Exceptions\DelicacyNotFoundException;
use App\Models\Delicacy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class DelicacyRepository
 * @package App\ModelControllers\Repositories
 */
class DelicacyRepository
{
	/***
	 * @param int $id
	 * @return Delicacy
	 * @throws DelicacyNotFoundException
	 */
	public function findById(int $id): Delicacy
	{
		$delicacy = Delicacy::where('id', '=', $id)->first();
		if ($delicacy === NULL) {
			throw new DelicacyNotFoundException();
		}
		return $delicacy;
	}

	/*** @return Collection */
	public function getAll(): Collection
	{
		return Delicacy::all();
	}

	/**
	 * @param array $ids
	 * @return array
	 */
	public function getTitlesArrayByIds(array $ids): array
	{
		$delicacies = DB::table('delicacies')
			->select('id', 'title')
			->whereIn('id', $ids)
			->pluck('id', 'title')
			->toArray();
		$result     = [];
		foreach ($delicacies as $key => $value) {
			$result[$key] = array_count_values($ids)[$value];
		}
		return $result;
	}
}