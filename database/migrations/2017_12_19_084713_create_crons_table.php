<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCronsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crons', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('CRON_name')->nullable();
			$table->timestamps();
			$table->string('CRON_job')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('crons');
	}

}
