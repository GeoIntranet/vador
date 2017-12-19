<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBilanactuPmpTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bilanactu_pmp', function(Blueprint $table)
		{
			$table->string('article', 50)->default('')->index('article');
			$table->boolean('id_etat')->default(0);
			$table->decimal('pmp_ht', 10)->unsigned()->nullable()->default(0.01)->comment('Valaeur d\'acaht du produit en euro');
			$table->primary(['article','id_etat']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bilanactu_pmp');
	}

}
