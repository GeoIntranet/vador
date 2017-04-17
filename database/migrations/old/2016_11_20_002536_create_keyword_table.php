<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeywordTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('keyword', function(Blueprint $table)
		{
			$table->smallInteger('id_keyword', true)->unsigned();
			$table->char('type', 5)->default('')->index('type');
			$table->boolean('ordre')->default(0);
			$table->string('keyword', 50)->default('');
			$table->string('keyword_uk', 50)->default('');
			$table->char('value', 10)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('keyword');
	}

}
