<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCrmActionCompTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crm_action_comp', function(Blueprint $table)
		{
			$table->increments('id_action')->comment('ID de l\'action');
			$table->char('ac_type_action_comp', 3)->nullable()->comment('type de l\'action (en 3 lettre max) (dans une liste sur keyword)');
			$table->string('ac_item_type', 30)->nullable()->comment('Type ou famille de produit');
			$table->string('ac_item_marque', 30)->nullable()->comment('marque de l\'item');
			$table->string('ac_item_model', 30)->nullable()->comment('model ou nom du produit');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('crm_action_comp');
	}

}
