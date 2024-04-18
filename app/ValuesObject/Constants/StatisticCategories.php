<?php

namespace App\ValuesObject\Constants;

/**
 * Class StatisticCategories
 * @package App\ValuesObject\Constants
 */
class StatisticCategories
{
	/*** @var string */
	public const COFFEES = 'coffees';
	/*** @var string */
	public const DELICACIES = 'delicacies';
	/*** @var string */
	public const ADDITIONS = 'additions';
	/*** @var string */
	public const SEATS = 'seats';

	/*** @var array */
	public const ALL = [
		self::COFFEES,
		self::DELICACIES,
		self::ADDITIONS,
		self::SEATS,
	];

	/*** @var array */
	public const WITH_TEXT = [
		self::COFFEES   => "Кава",
		self::DELICACIES => "Смаколики",
		self::ADDITIONS => "Добавки",
		self::SEATS    => "Місця",
	];
}