<?php

namespace App\ModelControllers;

use App\Exceptions\AdditionNotFoundException;
use App\ModelControllers\Repositories\AdditionRepository;
use App\Models\Addition;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class AdditionController
 * @package App\ModelControllers
 */
class AdditionController
{
	use HasFactory;

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
	 * @param string $title
	 * @return Addition
	 * @throws AdditionNotFoundException
	 */
	public function findByTitle(string $title): Addition
	{
		return $this->repo->findByTitle($title);
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
}