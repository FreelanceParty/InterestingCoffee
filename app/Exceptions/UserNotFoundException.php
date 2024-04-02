<?php

namespace App\Exceptions;

use Exception;

/**
 * Class UserNotFoundException
 * @package App\Exceptions
 */
class UserNotFoundException extends Exception
{
	/*** @var string */
	protected $message = 'User Not Found';
}