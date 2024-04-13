<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

/**
 * Class AuthenticatedSessionController
 * @package App\Http\Controllers\Auth
 */
class AuthenticatedSessionController extends Controller
{
	/*** Handle an incoming authentication request. */
	public function store(LoginRequest $request): JsonResponse
	{
		try {
			$request->authenticate();
			$request->session()->regenerate();
			return response()->json([
				'ack' => "success",
			]);
		} catch (Throwable) {
			return response()->json([
				'ack' => "fail",
			]);
		}
	}

	/*** Destroy an authenticated session. */
	public function destroy(Request $request): RedirectResponse
	{
		Auth::guard('web')->logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		return redirect('/');
	}
}
