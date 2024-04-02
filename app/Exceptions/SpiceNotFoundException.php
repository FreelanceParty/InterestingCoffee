<?php

namespace App\Exceptions;

use Exception;

/**
 * Class SpiceNotFoundException
 * @package App\Exceptions
 */
class SpiceNotFoundException extends Exception
{
	/*** @var string */
	protected $message = "Spice Not Found";
}
