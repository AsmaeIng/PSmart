<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToImapTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('imap', function(Blueprint $table)
		{
			$table->foreign('ISP_id', 'ISP_id')->references('id')->on('isps')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('imap', function(Blueprint $table)
		{
			$table->dropForeign('ISP_id');
		});
	}

}
