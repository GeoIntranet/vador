<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocator2014Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locator_2014', function(Blueprint $table)
		{
			$table->integer('id_locator', true);
			$table->string('article', 50)->nullable()->index('article');
			$table->text('description', 65535)->nullable()->index('description')->comment('description et etat de la machine');
			$table->boolean('id_etat')->nullable()->default(0)->comment('id_etat de id (neuf=1, occase=11,....)');
			$table->string('num_serie', 30)->nullable()->index('num_serie');
			$table->boolean('hs')->nullable()->default(0);
			$table->boolean('neuf')->nullable()->default(0);
			$table->string('locator', 15)->nullable()->index('locator');
			$table->string('in_fournisseur', 40)->nullable();
			$table->decimal('pu_ht', 10)->unsigned()->nullable()->default(0.01)->comment('Valaeur d\'acaht du produit en euro');
			$table->string('in_transport', 40)->nullable()->comment('transporteur et etat de recep du colis');
			$table->boolean('in_solde')->nullable();
			$table->string('in_presta', 40)->nullable()->comment('achat, retour, ... + Num Cmd');
			$table->boolean('in_id_user')->nullable();
			$table->dateTime('in_datetime')->nullable()->index('in_date');
			$table->boolean('aud_id_user')->nullable();
			$table->dateTime('aud_datetime')->nullable()->comment('Date Heure de l\'audit');
			$table->string('out_id_cmd', 7)->nullable();
			$table->boolean('out_id_user')->nullable();
			$table->dateTime('out_datetime')->nullable()->index('out_date');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('locator_2014');
	}

}
