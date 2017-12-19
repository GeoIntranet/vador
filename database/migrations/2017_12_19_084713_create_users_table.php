<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('USER_id')->nullable();
			$table->string('USER_postefixe')->nullable();
			$table->string('USER_nom')->nullable();
			$table->string('USER_prenom')->nullable();
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->timestamps();
			$table->string('USER_lognec')->nullable();
			$table->string('USER_postemobil')->nullable();
			$table->string('USER_postedef')->nullable();
			$table->string('USER_gsmboulot')->nullable();
			$table->string('USER_telperso')->nullable();
			$table->string('USER_datenais')->nullable();
			$table->string('USER_fonction')->nullable();
			$table->string('USER_divers')->nullable();
			$table->string('USER_photo')->nullable();
			$table->string('USER_icone')->nullable();
			$table->string('USER_tech_divers')->nullable();
			$table->boolean('USER_type')->nullable();
			$table->boolean('USER_t_com')->nullable();
			$table->boolean('USER_t_crm')->nullable();
			$table->boolean('USER_t_tech')->nullable();
			$table->boolean('USER_t_in')->nullable();
			$table->boolean('USER_t_art')->nullable();
			$table->boolean('USER_t_prix')->nullable();
			$table->boolean('USER_t_dp')->nullable();
			$table->boolean('USER_po_ref_sp')->nullable();
			$table->boolean('USER_po_valid')->nullable();
			$table->boolean('USER_po_acheteur')->nullable();
			$table->string('USER_nss')->nullable();
			$table->date('USER_dt_in')->nullable();
			$table->string('USER_cdi')->nullable();
			$table->string('USER_cdd')->nullable();
			$table->date('USER_cdd_dt')->nullable();
			$table->string('USER_g')->nullable();
			$table->string('USER_compagny')->nullable();
			$table->string('USER_section')->nullable();
			$table->string('remember_token', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
