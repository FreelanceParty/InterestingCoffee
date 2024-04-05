<?php

namespace App\Models;

use App\Models\Abstracts\AModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Feedback
 * @property string user_name
 * @property string text
 * @package App\Models
 */
class Feedback extends AModel
{
	/*** @var string */
	protected $table = 'feedbacks';

	use HasFactory;

	/*** @return string */
	public function getUserName(): string
	{
		return $this->user_name;
	}

	/**
	 * @param string $userName
	 * @return void
	 */
	public function setUserName(string $userName): void
	{
		$this->user_name = $userName;
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
}
