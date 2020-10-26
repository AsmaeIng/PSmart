<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDropsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('drops', function(Blueprint $table)
		{
			$table->foreign('data_id', 'data_id')->references('id')->on('data')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('liste_id', 'liste_id')->references('id')->on('listecontact')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('network_id', 'network_id')->references('id')->on('networks')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('offre_id', 'offre_id')->references('id')->on('offre')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('drops', function(Blueprint $table)
		{
			$table->dropForeign('data_id');
			$table->dropForeign('liste_id');
			$table->dropForeign('network_id');
			$table->dropForeign('offre_id');
		});
	}

}
