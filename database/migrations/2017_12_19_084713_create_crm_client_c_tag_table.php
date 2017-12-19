<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCrmClientCTagTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crm_client_c_tag', function(Blueprint $table)
		{
			$table->string('id_client', 6)->index('client')->comment('id client');
			$table->char('tag', 5)->index('tag')->comment('Tag sur ce client');
			$table->primary(['id_client','tag']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('crm_client_c_tag');
	}

}
