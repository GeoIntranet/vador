<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCrmRequeteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crm_requete', function(Blueprint $table)
		{
			$table->increments('id_liste')->comment('ID de la liste (increment auto)');
			$table->smallInteger('id_utilisateur')->unsigned()->nullable()->default(0)->comment('Id de l\'utilisateur qui a fait la sauvegarde');
			$table->string('titre', 200)->nullable()->comment('Titre de la sauvegarde');
			$table->dateTime('dt_svg')->nullable()->comment('date time de sauvegarde');
			$table->text('explication', 65535)->nullable()->comment('Explication de la sauvegarde');
			$table->text('r_sql', 65535)->nullable()->comment('tableau serialize de la requette sql');
			$table->text('r_txt', 65535)->nullable()->comment('tableau serialize de la requette txt');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('crm_requete');
	}

}
