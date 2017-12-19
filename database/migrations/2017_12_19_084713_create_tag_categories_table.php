<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tag_categories', function(Blueprint $table)
		{
			$table->string('CAT_famille')->default('')->primary();
			$table->boolean('CAT_therm')->nullable();
			$table->boolean('CAT_mic')->nullable();
			$table->boolean('CAT_pisto')->nullable();
			$table->boolean('CAT_las')->nullable();
			$table->boolean('CAT_mat')->nullable();
			$table->boolean('CAT_as')->nullable();
			$table->boolean('CAT_jet')->nullable();
			$table->boolean('CAT_tps')->nullable();
			$table->boolean('CAT_mo')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tag_categories');
	}

}
