<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class IsNotAdmin
 * @package App\Http\Middleware
 */
class IsNotAdmin
{
	/**
	 * Handle an incoming request.
	 * @param Closure(Request): (Response) $next
	 */
	public function handle(Request $request, Closure $next): Response
	{
		/*** @var User $authUser */
		$authUser = Auth::user();
		if ($authUser !== NULL && ! $authUser->isAdmin()) {
			return $next($request);
		}
		abort(403);
	}
}
