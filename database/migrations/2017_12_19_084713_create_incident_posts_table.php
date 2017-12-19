<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIncidentPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('incident_posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('incident_id');
			$table->boolean('user_id');
			$table->boolean('POST_target');
			$table->boolean('POST_action');
			$table->text('POST_content');
			$table->timestamps();
			$table->dateTime('POST_datetime')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('incident_posts');
	}

}
