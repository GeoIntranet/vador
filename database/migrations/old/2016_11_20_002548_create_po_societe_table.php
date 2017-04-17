<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePoSocieteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('po_societe', function(Blueprint $table)
		{
			$table->smallInteger('pos_id', true)->unsigned();
			$table->boolean('pos_etat')->nullable()->default(1);
			$table->string('pos_nom', 80)->nullable();
			$table->string('pos_numclient', 25)->nullable();
			$table->string('pos_memo', 250)->nullable();
			$table->string('pos_i_achat', 250)->nullable();
			$table->string('pos_i_port', 250)->nullable();
			$table->char('pos_fruk', 2)->nullable()->default('FR');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('po_societe');
	}

}
