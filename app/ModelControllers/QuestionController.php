<?php

namespace App\ModelControllers;

use App\Exceptions\QuestionNotFoundException;
use App\ModelControllers\Repositories\QuestionRepository;
use App\Models\Question;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class QuestionController
 * @package App\ModelControllers
 */
class QuestionController
{
	/*** @var QuestionRepository */
	private QuestionRepository $repo;

	/*** @return void */
	public function __construct()
	{
		$this->repo = new QuestionRepository();
	}

	/**
	 * @param int $id
	 * @return Question
	 * @throws QuestionNotFoundException
	 */
	public function findById(int $id): Question
	{
		return $this->repo->findById($id);
	}

	/*** @return array */
	public function getAllWithoutAnswer(): array
	{
		return $this->repo->getAllWithoutAnswer();
	}

	/**
	 * @param int $userId
	 * @return array
	 */
	public function getAllForUser(int $userId): array
	{
		return $this->repo->getAllForUser($userId);
	}

	/*** @return Collection */
	public function getAll(): Collection
	{
		return $this->repo->getAll();
	}
}