<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItBlTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('it_bl', function(Blueprint $table)
		{
			$table->string('id_cmd', 7)->default('')->primary();
			$table->boolean('id_tech')->nullable()->index('id_tech');
			$table->dateTime('lastact')->nullable();
			$table->text('explic', 65535)->nullable();
			$table->text('info_as', 65535)->nullable();
			$table->boolean('invalid')->nullable()->index('invalid');
			$table->date('dt_prod')->nullable()->index('dt_prod');
			$table->boolean('niv_prod')->nullable();
			$table->text('info_prod', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('it_bl');
	}

}
