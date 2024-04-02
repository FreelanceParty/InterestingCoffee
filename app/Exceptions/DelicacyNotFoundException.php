<?php

namespace App\Exceptions;

use Exception;

/**
 * Class DelicacyNotFoundException
 * @package App\Exceptions
 */
class DelicacyNotFoundException extends Exception
{
	/*** @var string */
	protected $message = "Delicacy Not Found";
}
