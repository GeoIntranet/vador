<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItBlTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('it_bl', function(Blueprint $table)
		{
			$table->string('id_cmd', 7)->default('')->primary();
			$table->boolean('id_tech')->nullable()->index('id_tech');
			$table->dateTime('lastact')->nullable();
			$table->text('explic', 65535)->nullable()->comment('Info technique');
			$table->text('info_as', 65535)->nullable()->comment('info Saisie a la redaction sur as400');
			$table->boolean('invalid')->nullable()->index('invalid')->comment('1 si fiche dé-validé');
			$table->date('dt_prod')->nullable()->index('dt_prod')->comment('Date prevue pour la production.');
			$table->boolean('niv_prod')->nullable()->comment('Niveau de production.');
			$table->text('info_prod', 65535)->nullable()->comment('Courte info sur la prod.');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('it_bl');
	}

}
