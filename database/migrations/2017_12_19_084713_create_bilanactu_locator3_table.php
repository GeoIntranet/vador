<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBilanactuLocator3Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bilanactu_locator3', function(Blueprint $table)
		{
			$table->string('article', 50)->index('article');
			$table->string('famille', 50)->nullable();
			$table->string('designation', 50)->nullable();
			$table->string('art_type', 50)->nullable();
			$table->string('image', 50)->nullable();
			$table->decimal('val_occ', 10)->unsigned()->nullable();
			$table->decimal('val_neuf', 10)->nullable();
			$table->decimal('val_hs', 10)->nullable();
			$table->decimal('val_cmrk', 10)->nullable();
			$table->decimal('val_ccmp', 10)->nullable();
			$table->decimal('val_tot', 10)->nullable()->index('valeur');
			$table->smallInteger('nb_occ')->unsigned()->nullable();
			$table->smallInteger('nb_neuf')->unsigned()->nullable();
			$table->smallInteger('nb_hs')->unsigned()->nullable();
			$table->smallInteger('nb_cmrk')->unsigned()->nullable();
			$table->smallInteger('nb_ccmp')->unsigned()->nullable();
			$table->decimal('pmp_occ', 10)->unsigned()->nullable();
			$table->decimal('pmp_neuf', 10)->nullable();
			$table->decimal('pmp_hs', 10)->nullable();
			$table->decimal('pmp_cmrk', 10)->nullable();
			$table->decimal('pmp_ccmp', 10)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bilanactu_locator3');
	}

}
