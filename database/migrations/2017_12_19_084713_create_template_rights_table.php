<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTemplateRightsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('template_rights', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('TEMPLATE_id');
			$table->boolean('TEMPLATE_user_id');
			$table->text('TEMPLATE_M1');
			$table->boolean('TEMPLATE_M1_mode');
			$table->text('TEMPLATE_M2');
			$table->boolean('TEMPLATE_M2_mode');
			$table->text('TEMPLATE_M3');
			$table->boolean('TEMPLATE_M3_mode');
			$table->text('TEMPLATE_M4');
			$table->boolean('TEMPLATE_M4_mode');
			$table->text('TEMPLATE_M5');
			$table->boolean('TEMPLATE_M5_mode');
			$table->text('TEMPLATE_M6');
			$table->boolean('TEMPLATE_M6_mode');
			$table->text('TEMPLATE_M7');
			$table->boolean('TEMPLATE_M7_mode');
			$table->text('TEMPLATE_M8');
			$table->boolean('TEMPLATE_M8_mode');
			$table->text('TEMPLATE_M9');
			$table->boolean('TEMPLATE_M9_mode');
			$table->text('TEMPLATE_M10');
			$table->boolean('TEMPLATE_M10_mode');
			$table->text('TEMPLATE_M11');
			$table->boolean('TEMPLATE_M11_mode');
			$table->boolean('TEMPLATE_rapidsearch');
			$table->boolean('TEMPLATE_google');
			$table->boolean('TEMPLATE_news');
			$table->boolean('TEMPLATE_news_mod');
			$table->boolean('TEMPLATE_fav');
			$table->boolean('TEMPLATE_fav_mod');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('template_rights');
	}

}
