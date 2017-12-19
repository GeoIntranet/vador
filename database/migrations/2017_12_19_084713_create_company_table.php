<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompanyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('company', function(Blueprint $table)
		{
			$table->smallInteger('id_company')->unsigned()->default(0)->primary();
			$table->boolean('actif')->nullable()->default(1);
			$table->string('name', 40)->nullable();
			$table->string('contact', 50)->nullable();
			$table->string('fax', 25)->nullable();
			$table->string('tel', 25)->nullable();
			$table->string('email', 70)->nullable();
			$table->string('aim', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('company');
	}

}
