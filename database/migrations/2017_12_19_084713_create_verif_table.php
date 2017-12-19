<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVerifTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('verif', function(Blueprint $table)
		{
			$table->increments('verif_id')->comment('ID de la table');
			$table->smallInteger('verif_id_utilisateur')->unsigned()->nullable()->comment('ID utilisateur');
			$table->dateTime('verif_dt')->nullable();
			$table->string('verif_locator', 15)->nullable();
			$table->text('verif_liste_base', 65535)->nullable()->comment('liste des id a la base');
			$table->text('verif_liste_saisie', 65535)->nullable();
			$table->smallInteger('verif_delta_qte')->nullable()->default(0)->comment('dif en qte id entre prevue et saisie');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('verif');
	}

}
