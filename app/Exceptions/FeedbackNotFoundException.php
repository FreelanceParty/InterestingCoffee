<?php

namespace App\Exceptions;

use Exception;

/**
 * Class FeedbackNotFoundException
 * @package App\Exceptions
 */
class FeedbackNotFoundException extends Exception
{
	/*** @var string */
	protected $message = "Feedback Not Found";
}
