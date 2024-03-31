<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 */
class User extends Authenticatable
{
	use HasFactory;

	/**
	 * The attributes that should be cast.
	 * @var array<string, string>
	 */
	protected $casts = [
		'password' => 'hashed',
	];
}
