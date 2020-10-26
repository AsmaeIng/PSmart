<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserHasGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_has_groups', function(Blueprint $table)
		{
			$table->bigInteger('user_id')->unsigned();
			$table->bigInteger('group_id')->unsigned()->index('user_has_groups_group_id_foreign');
			$table->primary(['user_id','group_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_has_groups');
	}

}
