<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserHasPermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_has_permissions', function(Blueprint $table)
		{
			$table->bigInteger('user_id')->unsigned();
			$table->bigInteger('permission_id')->unsigned()->index('user_has_permissions_permission_id_foreign');
			$table->primary(['user_id','permission_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_has_permissions');
	}

}
