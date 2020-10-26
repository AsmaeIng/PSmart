<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToServerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('server', function(Blueprint $table)
		{
			$table->foreign('OS_id', 'OS_id')->references('id')->on('operating system')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('domain_id', 'domain_id')->references('id')->on('domains')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('server', function(Blueprint $table)
		{
			$table->dropForeign('OS_id');
			$table->dropForeign('domain_id');
		});
	}

}
