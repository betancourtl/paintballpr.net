<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePbplayersPbteamsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pbplayers_pbteams', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('player_team_id')->unsigned();
			$table->integer('player_id')->unsigned();
			$table->foreign('player_id')->references('id')->on('pbplayers');
			$table->foreign('player_team_id')->references('id')->on('pbteams');
			$table->integer('player_role_id')->unsigned();
			$table->foreign('player_role_id')->references('id')->on('pbroles');

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
		// remove foreign keys
		Schema::table('pbplayers_pbteams',function($table){
			$table->dropForeign('pbplayers_pbteams_player_role_id_foreign');
			$table->dropForeign('pbplayers_pbteams_player_team_id_foreign');
			$table->dropForeign('pbplayers_pbteams_player_id_foreign');
		});
		//remove the table
		Schema::drop('pbplayers_pbteams');
	}

}
