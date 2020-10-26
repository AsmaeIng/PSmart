<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserHasGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_has_groups', function(Blueprint $table)
		{
			$table->foreign('group_id')->references('id')->on('groups')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_has_groups', function(Blueprint $table)
		{
			$table->dropForeign('user_has_groups_group_id_foreign');
			$table->dropForeign('user_has_groups_user_id_foreign');
		});
	}

}
