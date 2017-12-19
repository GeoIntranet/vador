<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContratTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contrat', function(Blueprint $table)
		{
			$table->string('id_contrat', 7)->default('');
			$table->smallInteger('num_ligne')->default(0);
			$table->string('machine', 10)->default('');
			$table->string('designation', 25)->default('');
			$table->char('type_contrat', 1)->default('');
			$table->decimal('prix')->default(0.00);
			$table->string('num_serie', 30)->default('');
			$table->date('debut')->default('0000-00-00');
			$table->boolean('nb_mois')->default(0);
			$table->string('id_client', 6)->default('')->index('id_client');
			$table->string('marque', 5)->default('');
			$table->string('genre', 5)->default('');
			$table->boolean('actif')->default(0);
			$table->primary(['id_contrat','num_ligne']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contrat');
	}

}
