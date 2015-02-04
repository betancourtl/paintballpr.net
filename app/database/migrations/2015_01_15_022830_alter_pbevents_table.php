<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPbeventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pbevents',function($table){

		$table->integer('status'); // status of the event Open = 1 closed =0
	});


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pbevents', function ($table)
		{
			$table->dropColumn('status');
		});
	}
}
