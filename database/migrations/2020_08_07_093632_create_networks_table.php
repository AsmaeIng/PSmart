<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNetworksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('networks', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('plateform_id')->unsigned()->index('id-Plateform');
			$table->string('name', 220);
			$table->string('login', 220);
			$table->string('password', 280);
			$table->string('URLSignIn', 280);
			$table->string('AffiliateID', 280);
			$table->string('APIAccessKey', 280);
			$table->string('APIHostURL', 350);
			$table->string('logo', 280);
			$table->boolean('type')->nullable();
			$table->timestamp('deleted_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('networks');
	}

}
