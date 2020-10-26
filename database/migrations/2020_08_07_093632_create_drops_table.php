<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDropsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('drops', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('network_id')->unsigned()->index('network_id');
			$table->bigInteger('offre_id')->unsigned()->index('offre_id');
			$table->bigInteger('isp_id')->unsigned()->index('isp_id');
			$table->bigInteger('country_id')->unsigned()->index('country_id');
			$table->bigInteger('data_id')->unsigned()->index('data_id');
			$table->bigInteger('liste_id')->unsigned()->index('liste_id');
			$table->text('body', 65535);
			$table->text('header', 65535);
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
		Schema::drop('drops');
	}

}
