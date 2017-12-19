<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItClientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('it_client', function(Blueprint $table)
		{
			$table->string('id_client', 6)->default('')->primary();
			$table->boolean('id_tech')->nullable();
			$table->dateTime('lastact')->nullable();
			$table->text('explic', 65535)->nullable();
			$table->string('email_incident', 80)->nullable();
			$table->string('fils_de', 6)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('it_client');
	}

}
