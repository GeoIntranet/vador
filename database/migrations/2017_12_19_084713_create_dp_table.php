<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDpTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dp', function(Blueprint $table)
		{
			$table->increments('dp_id');
			$table->string('dp_model', 50)->nullable();
			$table->boolean('dp_crea_id_user')->nullable();
			$table->boolean('dp_resp_id_user')->nullable();
			$table->boolean('dp_in_id_user')->nullable();
			$table->char('dp_etat', 1)->nullable();
			$table->dateTime('dp_dt_dem')->nullable();
			$table->dateTime('dp_dt_rep')->nullable();
			$table->string('dp_id_client', 6)->nullable();
			$table->char('dp_clipro', 1)->nullable();
			$table->char('dp_devinf', 1)->nullable();
			$table->string('dp_urgence', 80)->nullable();
			$table->string('dp_prestation', 80)->nullable();
			$table->string('dp_descriptif', 80)->nullable();
			$table->string('dp_autre_ref', 80)->nullable();
			$table->smallInteger('dp_qte')->unsigned()->nullable();
			$table->char('dp_neufrmkt', 1)->nullable();
			$table->string('dp_garant', 80)->nullable();
			$table->string('dp_stock', 80)->nullable();
			$table->string('dp_prix_public', 15)->nullable();
			$table->string('dp_prix_aut1', 15)->nullable();
			$table->string('dp_lien_aut1', 80)->nullable();
			$table->string('dp_prix_aut2', 15)->nullable();
			$table->string('dp_lien_aut2', 80)->nullable();
			$table->string('dp_prix_aut3', 15)->nullable();
			$table->string('dp_lien_aut3', 80)->nullable();
			$table->string('dp_prix_vt_env', 15)->nullable();
			$table->string('dp_prix_compl', 80)->nullable();
			$table->text('dp_historique', 65535)->nullable();
			$table->string('dp_concurrent', 80)->nullable();
			$table->text('dp_dem_remarque', 65535)->nullable();
			$table->string('dp_rmkt_tarif', 15)->nullable();
			$table->string('dp_rmkt_etat', 80)->nullable();
			$table->string('dp_rmkt_source', 80)->nullable();
			$table->string('dp_neuf_tarif', 15)->nullable();
			$table->string('dp_neuf_source', 80)->nullable();
			$table->string('dp_garantie_base', 80)->nullable();
			$table->string('dp_garantie_ext3', 80)->nullable();
			$table->string('dp_garantie_ext5', 80)->nullable();
			$table->string('dp_maintenance', 80)->nullable();
			$table->string('dp_dispo', 80)->nullable();
			$table->text('dp_rep_remarque', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('dp');
	}

}
