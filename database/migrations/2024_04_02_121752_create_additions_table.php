<?php

use App\ValuesObject\Constants\AdditionType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/*** Run the migrations.*/
	public function up(): void
	{
		Schema::create('additions', static function(Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->float('price');
			$table->string('description')->nullable();
			$table->integer('addition_type_id')->default(AdditionType::OTHER);
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		});
		DB::statement("ALTER TABLE `additions` ADD `image` MEDIUMBLOB AFTER `price`");
	}
};
