<?php

namespace App\ModelControllers;

use App\Exceptions\SpiceNotFoundException;
use App\ModelControllers\Repositories\SpiceRepository;
use App\Models\Spice;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SpiceController
 * @package App\ModelControllers
 */
class SpiceController
{
	use HasFactory;

	/*** @var SpiceRepository */
	private SpiceRepository $repo;

	/*** @return void */
	public function __construct()
	{
		$this->repo = new SpiceRepository();
	}

	/***
	 * @param int $id
	 * @return Spice
	 * @throws SpiceNotFoundException
	 */
	public function findById(int $id): Spice
	{
		return $this->repo->findById($id);
	}

	/***
	 * @param string $title
	 * @return Spice
	 * @throws SpiceNotFoundException
	 */
	public function findByTitle(string $title): Spice
	{
		return $this->repo->findByTitle($title);
	}

	/*** @return Collection */
	public function getAll(): Collection
	{
		return $this->repo->getAll();
	}
}