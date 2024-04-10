<?php

namespace App\Exceptions;

use Exception;

/**
 * Class AdditionNotFoundException
 * @package App\Exceptions
 */
class AdditionNotFoundException extends Exception
{
	/*** @var string */
	protected $message = "Addition Not Found";
}
