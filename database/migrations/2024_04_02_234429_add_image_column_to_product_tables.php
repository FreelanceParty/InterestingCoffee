<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/*** Run the migrations. */
	public function up(): void
	{
		Schema::table('coffees', static function(Blueprint $table) {
			$table->binary('image')->after('price')->nullable();
		});
		Schema::table('delicacies', static function(Blueprint $table) {
			$table->binary('image')->after('price')->nullable();
		});
		Schema::table('spices', static function(Blueprint $table) {
			$table->binary('image')->after('price')->nullable();
		});
	}
};
