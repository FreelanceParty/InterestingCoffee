<?php

namespace App\ModelControllers\Repositories;

use App\Exceptions\QuestionNotFoundException;
use App\Models\Question;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class QuestionRepository
 * @package App\ModelControllers\Repositories
 */
class QuestionRepository
{
	/**
	 * @param int $id
	 * @return Question
	 * @throws QuestionNotFoundException
	 */
	public function findById(int $id): Question
	{
		$question = Question::where('id', '=', $id)->first();
		if ($question === NULL) {
			throw new QuestionNotFoundException;
		}
		return $question;
	}

	/*** @return array */
	public function getAllWithoutAnswer(): array
	{
		return DB::table('questions as t1')
			->join('users as t2', 't2.id', '=', 't1.user_id')
			->select(
				't1.id as id',
				't1.text as text',
				't1.created_at as date',
				't2.email as email',
			)->whereNull('t1.answer')
			->where('t2.id', '!=', Auth::user()->getId())
			->get()
			->toArray();
	}

	/**
	 * @param int $userId
	 * @return array
	 */
	public function getAllForUser(int $userId): array
	{
		return DB::table('questions as t1')
			->join('users as t2', 't2.id', '=', 't1.user_id')
			->select(
				't1.id as id',
				't1.text as text',
				't1.created_at as date',
				't1.answer as answer',
				't1.updated_at as answer_date',
				't2.email as email',
			)->where('t1.user_id', '=', $userId)
			->get()
			->toArray();
	}

	/*** @return Collection */
	public function getAll(): Collection
	{
		return Question::all();
	}
}