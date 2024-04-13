<?php

namespace App\ValuesObject\Constants;

/**
 * Class AdditionType
 * @package App\ValuesObject\Constants
 */
class AdditionType
{
	/*** @var string */
	public const SPICE = 0;
	/*** @var string */
	public const SYRUP = 1;
	/*** @var string */
	public const ALCOHOL = 2;
	/*** @var string */
	public const NUT = 3;
	/*** @var string */
	public const CHOCOLATE = 4;
	/*** @var string */
	public const OTHER = 99;

	/*** @var array */
	public const ALL = [
		self::SPICE,
		self::SYRUP,
		self::ALCOHOL,
		self::NUT,
		self::CHOCOLATE,
		self::OTHER,
	];

	/*** @var array */
	public const WITH_TEXT = [
		self::SPICE     => "Спеції",
		self::SYRUP     => "Сироп",
		self::ALCOHOL   => "Алкоголь",
		self::NUT       => "Горіхи",
		self::CHOCOLATE => "Шоколад",
		self::OTHER     => "Інше",
	];
}