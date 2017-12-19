<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItItTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('it_it', function(Blueprint $table)
		{
			$table->increments('id_it')->comment('Numero seq. de l\'enregistrement');
			$table->boolean('id_tech')->nullable()->comment('id du tech qui a fait la derniere maj');
			$table->dateTime('lastact')->nullable()->comment('date de la derniere modif');
			$table->string('titre', 150)->nullable()->comment('Titre et mots clef de l\'article');
			$table->text('explic', 65535)->nullable()->comment('article complet sur l\'info tech');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('it_it');
	}

}
