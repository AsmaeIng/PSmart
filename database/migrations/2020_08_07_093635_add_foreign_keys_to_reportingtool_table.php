<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToReportingtoolTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reportingtool', function(Blueprint $table)
		{
			$table->foreign('id_isps', 'id_isps')->references('id')->on('isps')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reportingtool', function(Blueprint $table)
		{
			$table->dropForeign('id_isps');
		});
	}

}
