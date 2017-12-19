<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCrmClientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crm_client', function(Blueprint $table)
		{
			$table->string('id_client', 6)->default('000000')->primary()->comment('Champ libre pour commentaire');
			$table->text('info', 65535)->nullable()->comment('Champ libre pour commentaire');
			$table->string('alerte', 200)->nullable()->comment('Alerte a mettre en evidence');
			$table->string('web', 100)->nullable();
			$table->integer('chiffre_affaire')->unsigned()->nullable()->comment('CA de la societe en Million d\'euro');
			$table->char('activite', 3)->nullable()->comment('activitÃ© de la sociÃ©tÃ© (value de keyword[acti])');
			$table->char('marque', 3)->nullable()->comment('marque ou enseigne de la societe');
			$table->char('interet_soc', 3)->nullable()->comment('niveau d\'interet de cet socitÃ©tÃ© pour eurocomputer (value dans keyword[i_soc])');
			$table->string('id_mere', 20)->nullable()->index('id_mere')->comment('id de la maison mere');
			$table->string('autre_fournis', 200)->nullable()->comment('liste des autres fournisseurs connues');
			$table->integer('id_contact_prioritaire')->unsigned()->nullable()->comment('numero du contact prioritaire pour ce client');
			$table->date('max_date_cmd')->nullable()->comment('date de der cmd calculé le matin ');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('crm_client');
	}

}
