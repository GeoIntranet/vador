<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCumulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cumules', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('CUMULE_user');
			$table->date('CUMULE_dt');
			$table->integer('CUMULE_rec');
			$table->integer('CUMULE_rec_maj');
			$table->integer('CUMULE_hp');
			$table->integer('CUMULE_hp_maj');
			$table->integer('CUMULE_hnp');
			$table->float('CUMULE_cp');
			$table->float('CUMULE_ef');
			$table->integer('CUMULE_rec_solde');
			$table->integer('CUMULE_hp_solde');
			$table->integer('CUMULE_hnp_solde');
			$table->float('CUMULE_cp_solde', 30, 1);
			$table->float('CUMULE_ef_solde', 30, 1);
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
		Schema::drop('cumules');
	}

}
