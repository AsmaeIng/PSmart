<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffreTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('offre', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('country_id')->unsigned()->index('country_id');
			$table->string('sid', 280);
			$table->string('name', 280);
			$table->string('vertical', 380);
			$table->string('sponsor', 380);
			$table->string('froms', 380);
			$table->string('subjects', 380);
			$table->string('imageOffre', 380);
			$table->boolean('active');
			$table->string('sensitiv', 380);
			$table->string('link', 380);
			$table->string('unsub', 380);
			$table->string('downloadSuppression', 380);
			$table->string('notWorkingDays', 380);
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
		Schema::drop('offre');
	}

}
