<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePdActionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pd_action', function(Blueprint $table)
		{
			$table->integer('id_pd')->unsigned()->default(0)->index('id_pd');
			$table->dateTime('dt_pd_action')->default('0000-00-00 00:00:00');
			$table->boolean('id_user')->default(0);
			$table->char('action', 1)->default('');
			$table->primary(['id_pd','dt_pd_action']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pd_action');
	}

}
