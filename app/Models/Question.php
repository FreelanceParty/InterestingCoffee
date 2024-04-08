<?php

namespace App\Models;

use App\Models\Abstracts\AModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Question
 * @property string      $text
 * @property int         $user_id
 * @property User        $user
 * @property string|NULL $answer
 * @package App\Models
 */
class Question extends AModel
{
	/*** @return BelongsTo */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	/*** @return int */
	public function getUserId(): int
	{
		return $this->user_id;
	}

	/**
	 * @param int $user_id
	 * @return void
	 */
	public function setUserId(int $user_id): void
	{
		$this->user_id = $user_id;
	}

	/*** @return string */
	public function getText(): string
	{
		return $this->text;
	}

	/**
	 * @param string $text
	 * @return void
	 */
	public function setText(string $text): void
	{
		$this->text = $text;
	}

	/*** @return string|NULL */
	public function getAnswer(): ?string
	{
		return $this->answer;
	}

	/**
	 * @param string|NULL $answer
	 * @return void
	 */
	public function setAnswer(?string $answer): void
	{
		$this->answer = $answer;
	}
}
