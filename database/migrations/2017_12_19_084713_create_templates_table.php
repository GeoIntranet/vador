<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTemplatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('templates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('TEMPLATE_number');
			$table->boolean('TEMPLATE_achat');
			$table->boolean('TEMPLATE_crm');
			$table->boolean('TEMPLATE_incident');
			$table->boolean('TEMPLATE_locator');
			$table->boolean('TEMPLATE_stat');
			$table->boolean('TEMPLATE_arrivee');
			$table->boolean('TEMPLATE_delais');
			$table->boolean('TEMPLATE_info');
			$table->boolean('TEMPLATE_content');
			$table->boolean('TEMPLATE_count');
			$table->boolean('TEMPLATE_block_small');
			$table->boolean('TEMPLATE_block_large');
			$table->boolean('TEMPLATE_block_medium');
			$table->text('TEMPLATE_1');
			$table->text('TEMPLATE_2');
			$table->text('TEMPLATE_3');
			$table->text('TEMPLATE_4');
			$table->text('TEMPLATE_5');
			$table->text('TEMPLATE_6');
			$table->text('TEMPLATE_7');
			$table->text('TEMPLATE_8');
			$table->text('TEMPLATE_9');
			$table->text('TEMPLATE_10');
			$table->text('TEMPLATE_11');
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
		Schema::drop('templates');
	}

}
