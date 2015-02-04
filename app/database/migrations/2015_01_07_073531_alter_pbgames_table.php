<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPbgamesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pbgames',function($table){
			$table->integer('team_1_id')->unsigned();
			$table->foreign('team_1_id')->references('id')->on('pbteams');
			$table->integer('team_2_id')->unsigned();
			$table->foreign('team_2_id')->references('id')->on('pbteams');
			$table->integer('pbgames_event_id')->unsigned();
			$table->foreign('pbgames_event_id')->references('id')->on('pbevents');
			$table->integer('team_1_score');
			$table->integer('team_2_score');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pbgames',function($table){
			$table->dropForeign('pbgames_team_1_id_foreign');
			$table->dropForeign('pbgames_team_2_id_foreign');
			$table->dropForeign('pbgames_pbgames_event_id_foreign');
			$table->dropColumn('team_1_score')->unsigned();
			$table->dropColumn('team_2_score')->unsigned();
		});
	}

}
