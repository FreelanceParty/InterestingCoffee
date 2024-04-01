<?php

namespace App\Exceptions;

use Exception;

/**
 * Class CoffeeNotFoundException
 * @package App\Exceptions
 */
class CoffeeNotFoundException extends Exception
{
	/*** @var string */
	protected $message = 'Coffee Not Found';
}