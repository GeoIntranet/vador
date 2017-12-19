<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			$table->string('famille')->default('')->primary();
			$table->boolean('therm')->nullable();
			$table->boolean('mic')->nullable();
			$table->boolean('pisto')->nullable();
			$table->boolean('las')->nullable();
			$table->boolean('mat')->nullable();
			$table->boolean('as')->nullable();
			$table->boolean('jet')->nullable();
			$table->boolean('tps')->nullable();
			$table->boolean('mo')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}

}
