<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wi', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('WI_id_incident');
			$table->integer('WI_user');
			$table->integer('WI_state');
			$table->integer('WI_dt');
			$table->integer('WI_client');
			$table->integer('WI_open');
			$table->integer('WI_lastact');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wi');
	}

}
