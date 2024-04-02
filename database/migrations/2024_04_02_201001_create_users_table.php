<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/*** Run the migrations. */
	public function up(): void
	{
		Schema::create('users', static function(Blueprint $table) {
			$table->id();
			$table->string('email');
			$table->string('password');
			$table->boolean('is_admin')->default(FALSE);
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->useCurrentOnUpdate();
		});
	}
};