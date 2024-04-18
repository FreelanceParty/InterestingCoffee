<?php

namespace App\Exceptions;

use Exception;

/**
 * Class StatisticNotFoundException
 * @package App\Exceptions
 */
class StatisticNotFoundException extends Exception
{
	/*** @var string */
	protected $message = 'Statistic Not Found';
}