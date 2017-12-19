<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePoOldTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('po_old', function(Blueprint $table)
		{
			$table->increments('id_po');
			$table->string('titre', 50)->nullable();
			$table->smallInteger('id_company')->unsigned()->nullable();
			$table->boolean('id_user')->nullable();
			$table->dateTime('dt_cmd')->nullable();
			$table->string('devise', 5)->nullable();
			$table->smallInteger('id_transport')->unsigned()->nullable();
			$table->smallInteger('id_paiement')->unsigned()->nullable();
			$table->string('options', 20)->nullable();
			$table->text('memo', 65535)->nullable();
			$table->date('dt_prev_arr')->nullable();
			$table->char('etat', 1)->nullable()->comment('Null:actif T:Terminé - T si tous elements recus ou annulés');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('po_old');
	}

}
