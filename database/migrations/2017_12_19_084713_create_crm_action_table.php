<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCrmActionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crm_action', function(Blueprint $table)
		{
			$table->increments('id_action')->comment('ID de l\'action');
			$table->smallInteger('id_utilisateur')->unsigned()->index('user')->comment('id de la personne qui a fait l\'action');
			$table->string('id_client', 6)->index('client')->comment('ID client');
			$table->dateTime('creat')->nullable()->comment('date et heure de l\'action');
			$table->dateTime('nextact')->nullable()->index('next_act')->comment('prochaine action ou rappel');
			$table->char('type_action', 3)->nullable()->index('type_action')->comment('type de l\'action (en 3 lettre max) (dans une liste sur keyword)');
			$table->text('info', 65535)->nullable()->comment('Champ libre pour commentaire');
			$table->boolean('actif')->nullable()->default(0)->index('actif')->comment('0 c\'est fait / 1 c\'est a faire');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('crm_action');
	}

}
