<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticles22014Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles2_2014', function(Blueprint $table)
		{
			$table->increments('id_article')->comment('ID de l\'article');
			$table->string('art_type', 30)->nullable()->comment('Type article (laser, ecran, pc,...)');
			$table->string('art_marque', 30)->nullable()->comment('Marque article  (HP, IBM, lex...)');
			$table->string('art_model', 50)->nullable()->default('')->unique('art_model')->comment('Model article (2480, Q2568C, TLP2844,...)');
			$table->string('art_model_long', 50)->nullable()->default('')->unique('art_model_long')->comment('ref en mode long (avec -)');
			$table->string('short_desc', 200)->nullable()->comment('mini description produit');
			$table->text('long_desc', 65535)->nullable()->comment('description complette du produit');
			$table->text('parts', 65535)->nullable()->comment('Liste de parts pour ce produit');
			$table->string('image', 50)->nullable()->comment('Photo ou image du produit');
			$table->boolean('id_createur')->nullable()->comment('Id du createur de cet article');
			$table->string('as400_article', 10)->nullable()->index('as400')->comment('ID de correspondance as400');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('articles2_2014');
	}

}
