<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('client', function(Blueprint $table)
		{
			$table->string('id_client', 6)->default('000000')->primary();
			$table->boolean('famille')->nullable()->index('famille');
			$table->string('nsoc', 30)->nullable()->index('nsoc');
			$table->string('adr1', 30)->nullable();
			$table->string('adr2', 30)->nullable();
			$table->string('cp', 5)->nullable()->index('cp');
			$table->string('ville', 25)->nullable()->index('ville');
			$table->date('date_crea')->nullable();
			$table->string('tel', 16)->nullable();
			$table->string('fax', 16)->nullable();
			$table->string('divers', 8)->nullable();
			$table->boolean('reglement')->nullable();
			$table->string('contact', 25)->nullable();
			$table->boolean('type_client')->nullable();
			$table->boolean('code_tva')->nullable();
			$table->boolean('bloque')->nullable();
			$table->boolean('id_vendeur')->nullable()->index('id_vendeur');
			$table->string('der_facture', 7)->nullable();
			$table->string('tva', 17)->nullable();
			$table->string('der_propal', 7)->nullable()->index('date_dercom');
			$table->string('site_net', 25)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('client');
	}

}
