<?php

namespace App\Models;

use App\Models\Abstracts\AProduct;
use App\ValuesObject\Constants\ProductType;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Addition
 * @property int $addition_type_id
 * @package App\Models
 */
class Addition extends AProduct
{
	use HasFactory;

	/*** @var string */
	public const PRODUCT_TYPE = ProductType::ADDITION;

	/**
	 * @return int
	 */
	public function getAdditionTypeId(): int
	{
		return $this->addition_type_id;
	}

	/**
	 * @param int $addition_type_id
	 * @return void
	 */
	public function setAdditionTypeId(int $addition_type_id): void
	{
		$this->addition_type_id = $addition_type_id;
	}
}
