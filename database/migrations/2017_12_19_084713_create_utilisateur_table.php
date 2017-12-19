<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUtilisateurTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('utilisateur', function(Blueprint $table)
		{
			$table->smallInteger('id_utilisateur')->unsigned()->default(0)->primary();
			$table->string('nom', 30)->default('')->index('Nom');
			$table->string('prenom', 20)->nullable()->index('Prenom');
			$table->string('login', 10)->default('')->index('Login');
			$table->string('log_nec', 20)->default('');
			$table->string('password', 15)->default('');
			$table->string('email', 80)->nullable();
			$table->string('postefix', 15)->nullable();
			$table->string('postemobil', 15)->nullable();
			$table->string('postedef', 15)->nullable();
			$table->string('gsmboulot', 15)->nullable();
			$table->string('gsmperso', 15)->nullable();
			$table->string('telperso', 15)->nullable();
			$table->date('datenais')->nullable();
			$table->date('datearrive')->nullable();
			$table->string('fonction', 30)->nullable();
			$table->string('mail_sign_add', 200)->nullable();
			$table->string('divers', 200)->nullable();
			$table->string('photo', 50)->nullable();
			$table->string('icone', 50)->nullable()->default('NC.PNG')->comment('nom de l\'icone de representation');
			$table->string('tech_divers', 200)->nullable();
			$table->boolean('type_user')->default(1)->comment('0:non actif 1:vendeur&tech 2:tech 3:vendeur 8:admin 9:debug');
			$table->boolean('t_com')->nullable()->default(0);
			$table->boolean('t_crm')->nullable()->default(0)->comment('droit sur le modul crm 5 admin CRM - 3 MAJ tous comptes - 2 Visu tous comptes (mais pas de modif) - 1 MAJ Uniqement ses clients');
			$table->boolean('t_tech')->nullable()->default(0);
			$table->boolean('t_in')->nullable()->default(0);
			$table->boolean('t_art')->nullable()->default(0)->comment('droit pour les maj articles');
			$table->boolean('t_prix')->nullable()->default(0)->comment('droit pour voir les prix achat 0= pas de visu 1=visu 2=modif');
			$table->boolean('t_dp')->nullable()->default(0)->comment('demande de prix');
			$table->boolean('po_ref_sp')->nullable()->default(0)->comment('Types affichaged des ref (0=avec - et 1 =sans -)');
			$table->smallInteger('po_valid')->nullable();
			$table->boolean('po_acheteur')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('utilisateur');
	}

}
