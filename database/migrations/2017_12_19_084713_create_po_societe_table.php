<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePoSocieteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('po_societe', function(Blueprint $table)
		{
			$table->smallInteger('pos_id', true)->unsigned();
			$table->boolean('pos_etat')->nullable()->default(1)->comment('0-inactif 1-actif ');
			$table->string('pos_nom', 80)->nullable();
			$table->string('pos_numclient', 25)->nullable();
			$table->string('pos_memo', 250)->nullable()->comment('divers info sur le fournisseur.... (franco, pw, promo..)');
			$table->string('pos_i_achat', 250)->nullable()->comment('information achat');
			$table->string('pos_i_port', 250)->nullable()->comment('information port');
			$table->char('pos_fruk', 2)->nullable()->default('FR')->comment('FR pour francais UK pour anglais');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('po_societe');
	}

}
