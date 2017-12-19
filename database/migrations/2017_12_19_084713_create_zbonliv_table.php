<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZbonlivTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zbonliv', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('id_facture', 7)->nullable()->index('id_fact');
			$table->string('code_article', 10)->nullable();
			$table->string('type_article', 10)->nullable();
			$table->string('desc_article', 50)->nullable();
			$table->float('prix_tot', 10)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zbonliv');
	}

}
