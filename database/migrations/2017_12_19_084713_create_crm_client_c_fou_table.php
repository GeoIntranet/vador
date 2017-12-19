<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCrmClientCFouTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crm_client_c_fou', function(Blueprint $table)
		{
			$table->string('id_client', 6)->comment('id client');
			$table->string('fournisseur', 20)->comment('nom d\'un autre fournisseur connu');
			$table->primary(['id_client','fournisseur']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('crm_client_c_fou');
	}

}
