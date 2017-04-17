<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmdLignesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmd_lignes', function(Blueprint $table)
		{
			$table->string('id_cmd', 7)->default('');
			$table->boolean('num_ligne')->default(0);
			$table->string('type_article', 10)->default('')->index('type_article');
			$table->string('code_article', 10)->default('')->index('code_article');
			$table->string('desc_article', 50)->nullable();
			$table->string('qte_cmd', 4)->nullable();
			$table->string('qte_livr', 4)->nullable();
			$table->string('qte_fact', 4)->nullable();
			$table->char('fr_export', 1)->nullable();
			$table->boolean('prestation')->nullable();
			$table->boolean('nbm_garantie')->nullable();
			$table->boolean('id_vendeur')->nullable()->index('id_vendeur');
			$table->string('xyz', 30)->nullable();
			$table->string('num_serie', 30)->nullable()->index('num_serie');
			$table->string('id_facture', 7)->nullable()->index('id_facture');
			$table->char('annulation', 1)->nullable();
			$table->decimal('prix_unit', 10)->nullable();
			$table->primary(['id_cmd','num_ligne']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmd_lignes');
	}

}
