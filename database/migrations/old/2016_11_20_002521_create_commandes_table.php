<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommandesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('commandes', function(Blueprint $table)
		{
			$table->string('id_cmd', 7)->default('')->primary();
			$table->date('date_cmd')->nullable()->index('date_cmd');
			$table->string('id_clientfact', 6)->nullable()->index('id_clientfact');
			$table->string('cd_cmd_cli', 15)->nullable();
			$table->boolean('md_vt')->nullable()->default(0);
			$table->integer('pds_colis')->unsigned()->nullable()->default(0);
			$table->string('contact_fact', 25)->nullable();
			$table->boolean('garantie')->nullable()->default(0);
			$table->boolean('etat_livr')->nullable()->default(0);
			$table->date('date_livr')->nullable()->index('date_livr');
			$table->string('id_clientlivr', 6)->nullable()->index('id_clientlivr');
			$table->char('fr_export', 1)->nullable();
			$table->char('transporteur', 3)->nullable();
			$table->string('bon_transport', 30)->nullable();
			$table->string('contact_livr', 25)->nullable();
			$table->boolean('id_vendeur')->nullable()->default(0)->index('id_vendeur');
			$table->boolean('etat_fact')->nullable()->default(0);
			$table->boolean('id_prepar')->nullable()->default(0);
			$table->time('time_prepar')->nullable();
			$table->string('id_facture', 7)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('commandes');
	}

}
