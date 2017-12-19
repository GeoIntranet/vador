<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInOutTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('in_out', function(Blueprint $table)
		{
			$table->smallInteger('id_inout', true)->unsigned()->comment('id de la table');
			$table->smallInteger('id_utilisateur_out')->unsigned()->default(0)->index('id_u_out')->comment('id de l utilisateur qui est absent');
			$table->dateTime('dt_out')->default('0000-00-00 00:00:00')->index('dt_out')->comment('date time de depart');
			$table->dateTime('dt_in')->default('0000-00-00 00:00:00')->index('dt_in')->comment('date time de retour');
			$table->string('motif', 100)->nullable()->comment('motif de l\'absence');
			$table->smallInteger('id_utilisateur_info')->unsigned()->default(0)->comment('id de l utilisateur qui a saisie l info');
			$table->dateTime('dt_info')->default('0000-00-00 00:00:00')->comment('date time de la saisie de l info');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('in_out');
	}

}
