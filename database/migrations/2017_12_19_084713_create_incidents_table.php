<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIncidentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('incidents', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('client_id', 6)->default('0')->index('id_client');
			$table->string('INCIDENTS_nsoc', 30)->nullable();
			$table->string('INCIDENTS_tel', 20)->nullable();
			$table->string('INCIDENTS_adr1', 30)->nullable();
			$table->string('INCIDENTS_adr2', 30)->nullable();
			$table->string('INCIDENTS_cp', 5)->nullable();
			$table->string('INCIDENTS_ville', 25)->nullable();
			$table->string('INCIDENTS_contact', 25)->default('');
			$table->string('commande_id', 7)->default('')->index('id_cmd');
			$table->string('INCIDENTS_serial', 30)->default('');
			$table->dateTime('INCIDENTS_open')->default('0000-00-00 00:00:00')->index('open');
			$table->dateTime('INCIDENTS_lastact')->default('0000-00-00 00:00:00')->index('lastact');
			$table->dateTime('INCIDENTS_nextact')->nullable();
			$table->boolean('INCIDENTS_level')->default(0);
			$table->boolean('INCIDENTS_etat')->default(0);
			$table->boolean('use_id')->default(0);
			$table->boolean('INCIDENTS_garant')->default(0);
			$table->string('INCIDENTS_titre', 200)->default('');
			$table->text('INCIDENTS_explic');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('incidents');
	}

}
