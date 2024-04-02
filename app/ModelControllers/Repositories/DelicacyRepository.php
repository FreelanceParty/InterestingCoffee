<?php

namespace App\ModelControllers\Repositories;

use App\Exceptions\DelicacyNotFoundException;
use App\Models\Delicacy;
use Illuminate\Database\Eloquent\Collection;

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

	/***
	 * @param string $title
	 * @return Delicacy
	 * @throws DelicacyNotFoundException
	 */
	public function findByTitle(string $title): Delicacy
	{
		$delicacy = Delicacy::where('title', '=', $title)->first();
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
}