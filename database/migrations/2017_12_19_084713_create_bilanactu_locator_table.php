<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBilanactuLocatorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bilanactu_locator', function(Blueprint $table)
		{
			$table->integer('id_locator', true);
			$table->string('article', 50)->nullable()->index('article');
			$table->boolean('id_etat')->nullable()->default(0);
			$table->boolean('neuf')->nullable()->default(0);
			$table->boolean('occ')->nullable()->default(0);
			$table->boolean('hs')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bilanactu_locator');
	}

}
