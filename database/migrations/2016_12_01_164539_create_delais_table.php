<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDelaisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('delais', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('id_cmd')->nullable();
			$table->integer('id_vendeur')->nullable();
			$table->string('client')->nullable();
			$table->string('user_prepa')->nullable();
			$table->date('date')->nullable();
			$table->boolean('devis')->nullable();
			$table->string('da')->nullable();
			$table->string('inc')->nullable();
			$table->boolean('therm')->nullable();
			$table->boolean('mic')->nullable();
			$table->boolean('mat')->nullable();
			$table->boolean('las')->nullable();
			$table->boolean('jet')->nullable();
			$table->boolean('as')->nullable();
			$table->boolean('pisto')->nullable();
			$table->integer('close')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('delais');
	}

}
