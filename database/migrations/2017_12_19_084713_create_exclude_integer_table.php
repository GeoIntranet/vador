<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExcludeIntegerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exclude_integer', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('bl')->nullable();
			$table->dateTime('date_livr')->nullable();
			$table->string('commande_ligne')->nullable();
			$table->integer('id_user')->nullable();
			$table->string('code_as')->nullable();
			$table->string('designation')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('exclude_integer');
	}

}
