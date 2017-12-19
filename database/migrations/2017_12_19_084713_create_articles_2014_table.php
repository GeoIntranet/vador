<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticles2014Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles_2014', function(Blueprint $table)
		{
			$table->string('article', 10)->default('')->primary();
			$table->string('marque', 10)->nullable();
			$table->string('famille', 10)->default('')->index('famille');
			$table->string('designation', 50)->default('');
			$table->boolean('complet')->nullable()->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('articles_2014');
	}

}
