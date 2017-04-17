<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIncidentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('incident', function(Blueprint $table)
		{
			$table->integer('id_incid', true);
			$table->string('id_client', 6)->default('0')->index('id_client');
			$table->string('nsoc', 30)->nullable();
			$table->string('tel', 20)->nullable();
			$table->string('adr1', 30)->nullable();
			$table->string('adr2', 30)->nullable();
			$table->string('cp', 5)->nullable();
			$table->string('ville', 25)->nullable();
			$table->string('contact', 25)->default('');
			$table->string('id_cmd', 7)->default('')->index('id_cmd');
			$table->string('num_serie', 30)->default('');
			$table->dateTime('open')->default('0000-00-00 00:00:00')->index('open');
			$table->dateTime('lastact')->default('0000-00-00 00:00:00')->index('lastact');
			$table->dateTime('nextact')->nullable();
			$table->boolean('level_incid')->default(0);
			$table->boolean('id_etat')->default(0);
			$table->boolean('id_tech')->default(0);
			$table->boolean('id_garant')->default(0);
			$table->string('titre', 200)->default('');
			$table->text('explic', 65535);
			$table->string('incid__color', 10)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('incident');
	}

}
