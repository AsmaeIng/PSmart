<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupHasPermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group_has_permissions', function(Blueprint $table)
		{
			$table->bigInteger('group_id')->unsigned();
			$table->bigInteger('permission_id')->unsigned()->index('group_has_permissions_permission_id_foreign');
			$table->primary(['group_id','permission_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('group_has_permissions');
	}

}
