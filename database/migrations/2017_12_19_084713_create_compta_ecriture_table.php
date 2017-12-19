<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComptaEcritureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('compta_ecriture', function(Blueprint $table)
		{
			$table->char('compte', 12)->nullable()->comment('numero de compte');
			$table->date('datecr')->nullable()->comment('date ecriture');
			$table->string('journal', 15)->nullable()->comment('journal');
			$table->string('piece', 15)->nullable();
			$table->string('libelle', 80)->nullable();
			$table->char('lettre', 5)->nullable();
			$table->float('debit', 10)->nullable();
			$table->float('credit', 10)->nullable();
			$table->float('solde', 10)->nullable();
			$table->date('datregl')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('compta_ecriture');
	}

}
