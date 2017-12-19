<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCrmRConCliTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crm_r_con_cli', function(Blueprint $table)
		{
			$table->string('id_client', 6)->index('id_client')->comment('id client en relation avec ce contact');
			$table->integer('id_contact')->unsigned()->index('id_contact')->comment('id contact en relation avec ce client');
			$table->primary(['id_client','id_contact']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('crm_r_con_cli');
	}

}
