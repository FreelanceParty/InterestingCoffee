<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Throwable;

/**
 * Class RegisteredUserController
 * @package App\Http\Controllers\Auth
 */
class RegisteredUserController extends Controller
{
	/**
	 * Handle an incoming registration request.
	 * @throws ValidationException
	 */
	public function store(Request $request): JsonResponse
	{
		try {
			$request->validate([
				'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
				'password' => ['required', 'confirmed', Rules\Password::defaults()],
			]);
			$user = User::create([
				'email'    => $request->email,
				'password' => Hash::make($request->password),
			]);
			event(new Registered($user));
			Auth::login($user);
			return response()->json([
				'ack' => "success",
			]);
		} catch (Throwable) {
			return response()->json([
				'ack' => "fail",
			]);
		}
	}
}
