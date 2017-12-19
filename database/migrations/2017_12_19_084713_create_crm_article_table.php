<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCrmArticleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crm_article', function(Blueprint $table)
		{
			$table->integer('id_article', true)->comment('ID de la table');
			$table->string('item_type', 30)->nullable();
			$table->boolean('ordre_type')->nullable()->default(5)->comment('ordre pour le type.');
			$table->string('item_marque', 30)->nullable();
			$table->boolean('ordre_marque')->nullable()->default(5)->comment('order pour les marques');
			$table->string('item_model', 30)->nullable();
			$table->boolean('ordre')->nullable()->default(5)->comment('Ordre pour facilier le choix a l\'affichage');
			$table->index(['item_type','item_marque','item_model'], 'doublon');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('crm_article');
	}

}
