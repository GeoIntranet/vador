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
			$table->string('id', 6)->default('000000')->primary();
			$table->boolean('CLIENT_famille')->nullable()->index('famille');
			$table->string('CLIENT_nom', 30)->nullable()->index('nsoc');
			$table->string('CLIENT_adresse1', 30)->nullable();
			$table->string('CLIENT_adresse2', 30)->nullable();
			$table->string('CLIENT_codePostal', 5)->nullable()->index('cp');
			$table->string('CLIENT_ville', 25)->nullable()->index('ville');
			$table->date('CLIENT_dateCreation')->nullable();
			$table->string('CLIENT_telephone', 16)->nullable();
			$table->string('CLIENT_fax', 16)->nullable();
			$table->string('CLIENT_divers', 8)->nullable();
			$table->boolean('CLIENT_reglement')->nullable();
			$table->string('CLIENT_contact', 25)->nullable();
			$table->boolean('CLIENT_type')->nullable();
			$table->boolean('CLIENT_codeTva')->nullable();
			$table->boolean('CLIENT_bloque')->nullable();
			$table->boolean('user_id')->nullable()->index('id_vendeur');
			$table->string('CLIENT_derniereFacture', 7)->nullable();
			$table->string('CLIENT_tva', 17)->nullable();
			$table->string('CLIENT_derniereProposition', 7)->nullable()->index('date_dercom');
			$table->string('CLIENT_siteWeb', 25)->nullable();
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
