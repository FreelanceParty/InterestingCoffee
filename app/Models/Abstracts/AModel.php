<?php

namespace App\Models\Abstracts;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AModel
 * @property int    $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method static where($column, $operator, $value)
 * @package App\Models\Abstracts
 */
class AModel extends Model
{
	/*** @return int */
	public function getId(): int
	{
		return $this->id;
	}

	/***@return Carbon */
	public function getCreatedAt(): Carbon
	{
		return $this->created_at;
	}

	/*** @return Carbon */
	public function getUpdatedAt(): Carbon
	{
		return $this->updated_at;
	}
}