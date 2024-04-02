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

/**
 * Class RegisteredUserController
 * @package App\Http\Controllers\Auth
 */
class RegisteredUserController extends Controller
{
	/*** Display the registration view. */
	public function create(): JsonResponse
	{
		return response()->json([
			'view' => view('auth.register')->render(),
		]);
	}

	/**
	 * Handle an incoming registration request.
	 * @throws ValidationException
	 */
	public function store(Request $request): RedirectResponse
	{
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
		return redirect(RouteServiceProvider::HOME);
	}
}
