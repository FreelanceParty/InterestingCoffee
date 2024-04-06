<?php

namespace App\ModelControllers\Repositories;

use App\Exceptions\FeedbackNotFoundException;
use App\Models\Feedback;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class DelicacyRepository
 * @package App\ModelControllers\Repositories
 */
class FeedbacksRepository
{
	/***
	 * @param int $id
	 * @return Feedback
	 * @throws FeedbackNotFoundException
	 */
	public function findById(int $id): Feedback
	{
		$feedback = Feedback::where('id', '=', $id)->first();
		if ($feedback === NULL) {
			throw new FeedbackNotFoundException();
		}
		return $feedback;
	}

	/*** @return Collection */
	public function getAll(): Collection
	{
		return Feedback::all();
	}
}