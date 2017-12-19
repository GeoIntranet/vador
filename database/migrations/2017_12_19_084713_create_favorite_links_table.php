<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFavoriteLinksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('favorite_links', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('id_link');
			$table->boolean('id_user');
			$table->text('LINK_url', 16777215);
			$table->text('LINK_color', 16777215);
			$table->text('LINK_icone', 16777215);
			$table->timestamps();
			$table->string('LINK_name')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('favorite_links');
	}

}
