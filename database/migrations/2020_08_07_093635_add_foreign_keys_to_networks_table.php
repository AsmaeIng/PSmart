<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToNetworksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('networks', function(Blueprint $table)
		{
			$table->foreign('plateform_id', 'plateform_id')->references('id')->on('plateformsponsor')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('networks', function(Blueprint $table)
		{
			$table->dropForeign('plateform_id');
		});
	}

}
