<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('server', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('OS_id')->unsigned()->index('OS_id');
			$table->bigInteger('domain_id')->unsigned()->index('domain_id');
			$table->bigInteger('provider_id')->unsigned()->index('provider_id');
			$table->string('alias', 280);
			$table->string('type', 280);
			$table->string('userName', 280);
			$table->string('password', 280);
			$table->dateTime('saleDate');
			$table->boolean('active');
			$table->string('api', 280);
			$table->dateTime('expirationDate');
			$table->string('price', 280);
			$table->string('sshPort', 280);
			$table->timestamps();
			$table->timestamp('deleted_at')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('server');
	}

}
