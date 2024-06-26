<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

/**
 * Class Authenticate
 * @package App\Http\Middleware
 */
class Authenticate extends Middleware
{
	/*** Get the path the user should be redirected to when they are not authenticated. */
	protected function redirectTo(Request $request): ?string
	{
		return $request->expectsJson() ? NULL : route('login');
	}
}
