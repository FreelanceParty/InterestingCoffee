<?php

namespace App\ModelControllers;

use App\Exceptions\AdditionNotFoundException;
use App\ModelControllers\Repositories\AdditionRepository;
use App\Models\Addition;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class AdditionController
 * @package App\ModelControllers
 */
class AdditionController
{
	/*** @var AdditionRepository */
	private AdditionRepository $repo;

	/*** @return void */
	public function __construct()
	{
		$this->repo = new AdditionRepository();
	}

	/***
	 * @param int $id
	 * @return Addition
	 * @throws AdditionNotFoundException
	 */
	public function findById(int $id): Addition
	{
		return $this->repo->findById($id);
	}

	/***
	 * @param int $addition_type_id
	 * @return Collection|Addition[]
	 * @throws AdditionNotFoundException
	 */
	public function getByTypeId(int $addition_type_id): array|Collection
	{
		return $this->repo->getByTypeId($addition_type_id);
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