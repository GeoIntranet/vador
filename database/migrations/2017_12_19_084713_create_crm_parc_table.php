<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCrmParcTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crm_parc', function(Blueprint $table)
		{
			$table->increments('id_parc')->comment('ID de l\'element du parc ');
			$table->string('id_client', 6)->default('000000')->index('client')->comment('ID client');
			$table->string('item_type', 30)->nullable()->comment('Type ou famille de produit');
			$table->string('item_marque', 30)->nullable()->comment('marque de l\'item');
			$table->string('item_model', 30)->nullable()->comment('model ou nom du produit');
			$table->string('info', 200)->nullable()->comment('Info sur cet item');
			$table->smallInteger('qte')->unsigned()->nullable()->comment('Qte de cet item si connu');
			$table->char('interet_item', 3)->nullable()->comment('niveau d\'interet de cet item pour le client value dans keyword[i-itm]');
			$table->date('prochain_mouv')->nullable()->comment('Date du prochain mouvement (achat echange fin garantie vente...)');
			$table->date('dt_maj')->nullable()->comment('Date de mise a jour de cette info');
			$table->boolean('by_nec')->nullable()->default(0)->comment('acheté chez : 0 non NEC, 1 NEC exclusivement, 2 un peu des 2');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('crm_parc');
	}

}
