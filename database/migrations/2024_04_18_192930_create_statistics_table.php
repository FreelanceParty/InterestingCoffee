<?php

use App\ValuesObject\Constants\StatisticCategories;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
	/*** Run the migrations. */
	public function up(): void
	{
		Schema::create('statistics', static function(Blueprint $table) {
			$table->id();
			$table->string('category');
			$table->json('list')->nullable();
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		});
		DB::table('statistics')->insert(['category' => StatisticCategories::COFFEES]);
		DB::table('statistics')->insert(['category' => StatisticCategories::ADDITIONS]);
		DB::table('statistics')->insert(['category' => StatisticCategories::DELICACIES]);
		DB::table('statistics')->insert(['category' => StatisticCategories::SEATS]);
	}
};
