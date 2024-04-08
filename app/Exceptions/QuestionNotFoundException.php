<?php

namespace App\Exceptions;

use Exception;

/**
 * Class QuestionNotFoundException
 * @package App\Exceptions
 */
class QuestionNotFoundException extends Exception
{
	/*** @var string */
	protected $message = 'Question Not Found';
}