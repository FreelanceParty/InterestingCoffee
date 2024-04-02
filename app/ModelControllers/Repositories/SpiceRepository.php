<?php

namespace App\ModelControllers\Repositories;

use App\Exceptions\SpiceNotFoundException;
use App\Models\Spice;
use Illuminate\Database\Eloquent\Collection;

/***
 * Class SpiceRepository
 * @package App\ModelControllers\Repositories
 */
class SpiceRepository
{
	/***
	 * @param int $id
	 * @return Spice
	 * @throws SpiceNotFoundException
	 */
	public function findById(int $id): Spice
	{
		$spice = Spice::where('id', '=', $id)->first();
		if ($spice === NULL) {
			throw new SpiceNotFoundException;
		}
		return $spice;
	}

	/***
	 * @param string $title
	 * @return Spice
	 * @throws SpiceNotFoundException
	 */
	public function findByTitle(string $title): Spice
	{
		$spice = Spice::where('title', '=', $title)->first();
		if ($spice === NULL) {
			throw new SpiceNotFoundException;
		}
		return $spice;
	}

	/*** @return Collection */
	public function getAll(): Collection
	{
		return Spice::all();
	}
}