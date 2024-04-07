<?php

namespace App\ValuesObject;

/**
 * Class ProductType
 * @package App\ValuesObject
 */
class ProductType
{
	/*** @var string */
	public const COFFEE = 'coffee';
	/*** @var string */
	public const DELICACY = 'delicacy';
	/*** @var string */
	public const SPICE = 'spice';
	/*** @var string */
	public const UNDEFINED = 'undefined';

	/*** @var array */
	public const ALL = [
		self::COFFEE,
		self::DELICACY,
		self::SPICE,
	];

	/*** @var array */
	public const WITH_TEXT = [
		self::COFFEE => "Кава",
		self::DELICACY => "Смаколик",
		self::SPICE => "Спеція",
	];

	/*** @var array */
	public const DEFAULT_IMAGE_PATH = [
		self::COFFEE   => 'images/coffee-default-img.png',
		self::DELICACY => 'images/delicacy-default-img.png',
		self::SPICE    => 'images/spice-default-img.png',
	];
}