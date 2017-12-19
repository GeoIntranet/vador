<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('po', function(Blueprint $table)
		{
			$table->increments('po_id');
			$table->string('po_titre', 50)->nullable();
			$table->smallInteger('po_pos_id')->unsigned()->nullable()->comment('ID de la société');
			$table->smallInteger('po_poc_id')->unsigned()->nullable()->comment('ID du contact (table po_contact)');
			$table->string('po_in_tr', 10)->nullable()->comment('Code du transporteur dans keyword type IN_TR');
			$table->smallInteger('po_user_id_creat')->unsigned()->nullable()->comment('ID du createur du PO');
			$table->smallInteger('po_user_id_in')->unsigned()->nullable()->comment('PO en cours chez...');
			$table->smallInteger('po_user_id_clivr')->unsigned()->nullable()->comment('User_id contact de livraison');
			$table->smallInteger('po_user_id_cfact')->unsigned()->nullable()->comment('user_id contact de facturartion');
			$table->dateTime('po_dt_cmd')->nullable()->comment('Date de creation du PO');
			$table->date('po_dt_prev_arr')->nullable()->comment('Date de livraison estimé');
			$table->string('po_devise', 10)->nullable()->comment('Devise de la commande');
			$table->string('po_paiement', 10)->nullable()->comment('keyword value type PAIFR');
			$table->text('po_memo_public', 65535)->nullable()->comment('Memo public visible sur la cmd');
			$table->text('po_memo_privat', 65535)->nullable()->comment('txt commentaire NON visible sur la cmd');
			$table->boolean('po_etat')->nullable()->default(1)->comment('1:actif 9:Terminé - 9 si tous elements recus ou annulés');
			$table->string('po_option', 50)->nullable()->comment('option mots cles de 3 lettres separé par espaces');
			$table->decimal('po_frais_port', 10)->nullable()->comment('Frais de ports en devises');
			$table->decimal('po_remise', 10)->nullable()->comment('Remmise en devises');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('po');
	}

}
