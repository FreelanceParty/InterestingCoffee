<?php

namespace App\ModelControllers;

use App\Exceptions\DelicacyNotFoundException;
use App\ModelControllers\Repositories\DelicacyRepository;
use App\Models\Delicacy;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class DelicacyController
 * @package App\ModelControllers
 */
class DelicacyController
{
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

	/*** @return Collection */
	public function getAll(): Collection
	{
		return $this->repo->getAll();
	}

	/**
	 * @param array $ids
	 * @return array
	 */
	public function getTitlesArrayByIds(array $ids): array
	{
		return $this->repo->getTitlesArrayByIds($ids);
	}
}