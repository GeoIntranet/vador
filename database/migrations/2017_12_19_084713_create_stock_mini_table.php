<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStockMiniTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stock_mini', function(Blueprint $table)
		{
			$table->increments('id_sm')->comment('ID de l\'article');
			$table->string('art_model', 50)->nullable()->default('')->unique('art_model')->comment('Model article (2480, Q2568C, TLP2844,...)');
			$table->text('short_desc', 65535)->nullable()->comment('mini description de la raison du stock mini');
			$table->smallInteger('qte_mini')->nullable()->comment('Qte Mini pour alerte');
			$table->boolean('id_createur')->nullable()->comment('Id du createur de cet article');
			$table->date('last_ok')->nullable()->default('2011-03-01')->comment('date de la derniere fois ou il y avait sufisament de stock.');
			$table->boolean('etat')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('stock_mini');
	}

}
