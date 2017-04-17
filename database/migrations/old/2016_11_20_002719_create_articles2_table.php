<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticles2Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles2', function(Blueprint $table)
		{
			$table->increments('id_article');
			$table->string('art_type', 30)->nullable();
			$table->string('art_marque', 30)->nullable();
			$table->string('art_model', 50)->nullable()->default('')->unique('art_model');
			$table->string('art_model_long', 50)->nullable()->default('')->unique('art_model_long');
			$table->string('short_desc', 200)->nullable();
			$table->text('long_desc', 65535)->nullable();
			$table->text('parts', 65535)->nullable();
			$table->string('image', 50)->nullable();
			$table->boolean('id_createur')->nullable();
			$table->string('as400_article', 10)->nullable()->index('as400');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('articles2');
	}

}
