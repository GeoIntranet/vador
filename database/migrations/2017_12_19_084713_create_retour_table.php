<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRetourTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('retour', function(Blueprint $table)
		{
			$table->integer('id_retour', true);
			$table->string('id_cmd', 7)->default('')->index('id_cmd');
			$table->string('article', 10)->nullable()->index('article');
			$table->date('date_livr')->nullable();
			$table->string('id_clientlivr', 6)->nullable()->index('id_clientlivr');
			$table->string('id_clientfact', 6)->nullable();
			$table->string('id_facture', 7)->nullable();
			$table->string('famille', 10)->nullable();
			$table->decimal('qte_livr', 4, 0)->nullable();
			$table->decimal('qte_out', 4, 0)->nullable();
			$table->boolean('solde')->nullable()->default(0)->index('solde');
			$table->text('comment', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('retour');
	}

}
