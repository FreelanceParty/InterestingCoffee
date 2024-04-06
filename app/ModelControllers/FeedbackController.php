<?php

namespace App\ModelControllers;

use App\Exceptions\FeedbackNotFoundException;
use App\ModelControllers\Repositories\FeedbacksRepository;
use App\Models\Feedback;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class FeedbackController
 * @package App\ModelControllers
 */
class FeedbackController
{
	/*** @var FeedbacksRepository */
	private FeedbacksRepository $repo;

	/*** @return void */
	public function __construct()
	{
		$this->repo = new FeedbacksRepository();
	}

	/***
	 * @param int $id
	 * @return Feedback
	 * @throws FeedbackNotFoundException
	 */
	public function findById(int $id): Feedback
	{
		return $this->repo->findById($id);
	}

	/*** @return Collection */
	public function getAll(): Collection
	{
		return $this->repo->getAll();
	}
}