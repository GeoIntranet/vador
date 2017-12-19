<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIntegerCommandTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('integer_command', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('bl')->default('');
			$table->boolean('commande_ligne');
			$table->date('date_cmd')->default('0000-00-00');
			$table->date('date_livr')->nullable();
			$table->string('client_livr', 6);
			$table->string('client_fact', 6);
			$table->float('laps_time', 10, 0)->nullable();
			$table->string('cp', 5);
			$table->integer('id_user');
			$table->text('code_as', 16777215);
			$table->text('designation', 16777215);
			$table->text('description', 16777215);
			$table->boolean('export_fr')->default(0);
			$table->boolean('garantie');
			$table->integer('qt_c')->default(0);
			$table->integer('qt_l');
			$table->integer('qt_f');
			$table->boolean('option');
			$table->decimal('prix_unit', 10, 0);
			$table->decimal('total', 10, 0);
			$table->boolean('prestation');
			$table->boolean('therm')->default(0);
			$table->boolean('pisto')->default(0);
			$table->boolean('micro')->default(0);
			$table->boolean('las')->default(0);
			$table->boolean('mat')->default(0);
			$table->boolean('as')->default(0);
			$table->boolean('jet')->default(0);
			$table->boolean('mo')->nullable();
			$table->boolean('tps')->nullable();
			$table->integer('facture')->nullable();
			$table->boolean('repair');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('integer_command');
	}

}
