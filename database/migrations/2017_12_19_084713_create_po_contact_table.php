<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePoContactTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('po_contact', function(Blueprint $table)
		{
			$table->increments('poc_id');
			$table->smallInteger('poc_pos_id')->unsigned()->nullable();
			$table->boolean('poc_etat')->nullable();
			$table->string('poc_nom', 80)->nullable();
			$table->string('poc_tel', 25)->nullable();
			$table->string('poc_fax', 25)->nullable();
			$table->string('poc_email', 80)->nullable();
			$table->string('poc_aim', 80)->nullable();
			$table->string('poc_fonction', 80)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('po_contact');
	}

}
