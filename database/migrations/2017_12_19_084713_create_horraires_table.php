<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHorrairesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('horraires', function(Blueprint $table)
		{
			$table->integer('user');
			$table->date('date_j')->default('0000-00-00');
			$table->date('date_r')->default('0000-00-00');
			$table->time('heures_taff')->nullable();
			$table->string('com')->nullable();
			$table->integer('recup')->nullable();
			$table->integer('heure_paye')->nullable();
			$table->boolean('check')->nullable();
			$table->boolean('cp')->nullable();
			$table->integer('cp2')->nullable();
			$table->boolean('ef')->nullable();
			$table->boolean('hnp')->nullable();
			$table->string('unknow', 10)->nullable();
			$table->timestamps();
			$table->integer('id', true);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('horraires');
	}

}
