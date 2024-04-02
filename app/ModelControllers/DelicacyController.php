<?php

namespace App\ModelControllers;

use App\Exceptions\DelicacyNotFoundException;
use App\ModelControllers\Repositories\DelicacyRepository;
use App\Models\Delicacy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DelicacyController
{
	use HasFactory;

	/*** @var DelicacyRepository */
	private DelicacyRepository $repo;

	/*** @return void */
	public function __construct()
	{
		$this->repo = new DelicacyRepository();
	}

	/***
	 * @param int $id
	 * @return Delicacy
	 * @throws DelicacyNotFoundException
	 */
	public function findById(int $id): Delicacy
	{
		return $this->repo->findById($id);
	}

	/***
	 * @param string $title
	 * @return Delicacy
	 * @throws DelicacyNotFoundException
	 */
	public function findByTitle(string $title): Delicacy
	{
		return $this->repo->findByTitle($title);
	}

	/*** @return Collection */
	public function getAll(): Collection
	{
		return $this->repo->getAll();
	}
}