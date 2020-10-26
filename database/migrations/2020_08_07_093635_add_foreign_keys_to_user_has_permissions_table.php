<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserHasPermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_has_permissions', function(Blueprint $table)
		{
			$table->foreign('permission_id')->references('id')->on('permissions')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
		Schema::table('user_has_permissions', function(Blueprint $table)
		{
			$table->dropForeign('user_has_permissions_permission_id_foreign');
			$table->dropForeign('user_has_permissions_user_id_foreign');
		});
	}

}
