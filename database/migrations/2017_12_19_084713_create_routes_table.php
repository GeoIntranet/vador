<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoutesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('routes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('ROUTE_name', 65535);
			$table->text('ROUTE_action', 65535);
			$table->text('ROUTE_groupe', 65535);
			$table->text('ROUTE_fullPath', 65535);
			$table->boolean('ROUTE_maintenance');
			$table->boolean('ROUTE_construction');
			$table->text('ROUTE_denied', 65535);
			$table->text('ROUTE_auth', 16777215)->nullable();
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
		Schema::drop('routes');
	}

}
