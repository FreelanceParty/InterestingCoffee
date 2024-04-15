<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/*** Run the migrations. */
	public function up(): void
	{
		Schema::create('orders', static function(Blueprint $table) {
			$table->id();
			$table->string('user_name');
			$table->string('phone_number');
			$table->integer('seats_count');
			$table->timestamp('date_time');
			$table->json('products_list')->nullable();
			$table->float('total_price');
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->useCurrentOnUpdate();
		});
	}
};
