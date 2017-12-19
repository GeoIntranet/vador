<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBilanactuArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bilanactu_articles', function(Blueprint $table)
		{
			$table->string('article', 50)->default('')->primary();
			$table->string('marque', 10)->nullable();
			$table->string('famille', 10)->default('')->index('famille');
			$table->string('designation', 50)->default('');
			$table->boolean('complet')->nullable()->default(1);
			$table->decimal('p_neuf')->default(0.00);
			$table->string('t_neuf', 50)->nullable();
			$table->decimal('p_occ')->default(0.00);
			$table->string('t_occ', 50)->nullable();
			$table->smallInteger('nbv3m')->unsigned()->nullable();
			$table->smallInteger('nbv6m')->unsigned()->nullable();
			$table->smallInteger('nbv12m')->unsigned()->nullable();
			$table->decimal('pmp_neuf')->nullable()->comment('prix achat moyen pondéré en euro ');
			$table->decimal('pmp_occ')->nullable()->comment('prix moyen pondéré acaht en euro');
			$table->decimal('dp_neuf')->nullable()->comment('Dernier prix connu en neuf');
			$table->decimal('dp_occ')->nullable();
			$table->boolean('coche')->nullable()->default(0)->comment('selectioner ou non');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bilanactu_articles');
	}

}
