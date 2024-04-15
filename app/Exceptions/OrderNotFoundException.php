<?php

namespace App\Exceptions;

use Exception;

/**
 * Class OrderNotFoundException
 * @package App\Exceptions
 */
class OrderNotFoundException extends Exception
{
	/*** @var string */
	protected $message = 'Order Not Found';
}