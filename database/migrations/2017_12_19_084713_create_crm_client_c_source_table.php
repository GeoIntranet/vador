<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCrmClientCSourceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crm_client_c_source', function(Blueprint $table)
		{
			$table->string('id_client', 6)->primary()->comment('id client');
			$table->string('source', 5)->nullable()->comment('Source pour les importations');
			$table->date('dt_in')->nullable()->comment('date de  l importation');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('crm_client_c_source');
	}

}
