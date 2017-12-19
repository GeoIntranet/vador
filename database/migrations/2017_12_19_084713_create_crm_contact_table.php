<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCrmContactTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crm_contact', function(Blueprint $table)
		{
			$table->increments('id_contact')->comment('ID automatique du contact');
			$table->string('civ', 10)->nullable()->comment('civilitÃ©');
			$table->string('nom', 50)->nullable()->comment('nom de famille');
			$table->string('prenom', 50)->nullable()->comment('prenom');
			$table->string('fonction', 50)->nullable()->comment('fonction');
			$table->string('telephone', 25)->nullable()->comment('telephone');
			$table->string('gsm', 25)->nullable()->comment('tel portable.');
			$table->string('fax', 25)->nullable()->comment('fax');
			$table->string('email', 200)->nullable()->comment('email du client (si plusieur, separation = ; )');
			$table->boolean('no_promo')->nullable()->default(0)->comment('1 = pas de promo mail ');
			$table->boolean('no_perso')->nullable()->default(0)->comment('1 = pas de mail perso');
			$table->string('chat', 100)->nullable()->comment('aim, msn, yahoo ? adresse de mes instantanÃ©');
			$table->text('info', 65535)->nullable()->comment('Champ libre pour commentaire');
			$table->char('interet_contact', 3)->nullable()->comment('niveau d\'interet de ce contact (value dans keyword[i_con])');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('crm_contact');
	}

}
