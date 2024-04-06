<?php

namespace App\ValuesObject;

/**
 * Class InfoType
 * @package App\ValuesObject
 */
class InfoType
{
	/*** @var string */
	public const SUCCESS = 'success';
	/*** @var string */
	public const ERROR = 'error';
	/*** @var string */
	public const INFO = 'info';

	/*** @var array */
	public const ICON_CLASSES = [
		self::SUCCESS => 'circle-check text-green-500',
		self::ERROR   => 'circle-exclamation text-red-500',
		self::INFO    => 'circle-info text-gray-500',
	];
}