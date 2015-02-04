<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPbeventPbteamTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pbevents_pbteams',function($table){

			$table->integer('event_id')->unsigned();
			$table->foreign('event_id')->references('id')->on('pbevents');
			$table->integer('event_team_id')->unsigned();
			$table->foreign('event_team_id')->references('id')->on('pbteams');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pbevents_pbteams',function($table){

			$table->dropForeign('pbevents_pbteams_event_id_foreign');
			$table->dropForeign('pbevents_pbteams_event_team_id_foreign');
		});
	}

}
