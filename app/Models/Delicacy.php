<?php

namespace App\Models;

use App\Models\Abstracts\AProduct;
use App\ValuesObject\ProductType;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Delicacy
 * @package App\Models
 */
class Delicacy extends AProduct
{
	use HasFactory;

	/*** @var string */
	public const PRODUCT_TYPE = ProductType::DELICACY;
}
