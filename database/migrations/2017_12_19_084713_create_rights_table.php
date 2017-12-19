<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRightsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rights', function(Blueprint $table)
		{
			$table->increments('right_id');
			$table->boolean('right_user_id');
			$table->boolean('right_act');
			$table->boolean('right_role');
			$table->boolean('right_therm');
			$table->boolean('right_mat');
			$table->boolean('right_jet');
			$table->boolean('right_mic');
			$table->boolean('right_as');
			$table->boolean('right_las');
			$table->boolean('right_pisto');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rights');
	}

}
