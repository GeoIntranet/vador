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
			$table->string('id', 7)->default('')->primary();
			$table->date('COMMANDE_date')->nullable()->index('date_cmd');
			$table->string('COMMANDE_clientfact', 6)->nullable()->index('id_clientfact');
			$table->string('COMMANDE_cd_cmd_cli', 15)->nullable();
			$table->boolean('COMMANDE_md_vt')->nullable()->default(0);
			$table->integer('COMMANDE_poid')->unsigned()->nullable()->default(0);
			$table->string('COMMANDE_contactFacturation', 25)->nullable();
			$table->boolean('COMMANDE_garantie')->nullable()->default(0);
			$table->boolean('COMMANDE_etatLivraison')->nullable()->default(0);
			$table->date('COMMANDE_dateLivraison')->nullable();
			$table->string('COMMANDE_clientLivraison', 6)->nullable()->index('id_clientlivr');
			$table->char('COMMANDE_frExport', 1)->nullable();
			$table->char('COMMANDE_transporteur', 3)->nullable();
			$table->string('COMMANDE_bonTransport', 30)->nullable();
			$table->string('COMMANDE_contactLivraison', 25)->nullable();
			$table->boolean('user_id')->nullable()->default(0)->index('id_vendeur');
			$table->boolean('COMMANDE_etatFacturation')->nullable()->default(0);
			$table->boolean('COMMANDE_idPreparateur')->nullable()->default(0);
			$table->time('COMMANDE_timePreparation')->nullable();
			$table->string('facture_id', 7)->nullable();
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
