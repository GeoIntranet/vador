<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEtikRappTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('etik_rapp', function(Blueprint $table)
		{
			$table->increments('id');
			$table->smallInteger('id_user')->unsigned()->nullable();
			$table->dateTime('dt')->nullable();
			$table->string('ident', 80)->nullable();
			$table->string('serial', 80)->nullable();
			$table->string('ip', 80)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('etik_rapp');
	}

}
