<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePdTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pd', function(Blueprint $table)
		{
			$table->increments('id_pd');
			$table->string('ref', 50)->nullable()->index('ref');
			$table->string('description', 200)->nullable();
			$table->string('id_cmd', 7)->nullable()->index('id_cmd');
			$table->text('memo', 65535)->nullable();
			$table->boolean('crea_id_user')->default(0)->index('crea_id_user');
			$table->boolean('in_id_user')->default(0)->index('in_id_user');
			$table->char('in_etat', 1)->default('');
			$table->integer('id_po')->unsigned()->nullable()->index('po');
			$table->integer('qte_dem')->unsigned()->nullable();
			$table->integer('qte_cmd')->unsigned()->nullable();
			$table->integer('qte_recu')->unsigned()->nullable();
			$table->decimal('prix_unit_ht', 10)->nullable();
			$table->decimal('prix_unit_ht_euro', 10)->nullable();
			$table->boolean('id_etat')->nullable()->default(0)->index('id_etat');
			$table->string('conditio', 10)->nullable();
			$table->string('cpt_anal', 10)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pd');
	}

}
