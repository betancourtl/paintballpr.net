<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPbplayersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pbplayers',function($table){
			$table->integer('player_image_id')->unsigned();
			$table->foreign('player_image_id')->references('id')->on('pbimages');
			$table->integer('player_user_id')->unsigned();
			$table->foreign('player_user_id')->references('id')->on('users');
			$table->integer('player_division_id')->unsigned();
			$table->foreign('player_division_id')->references('id')->on('pbdivisions');
			$table->integer('player_score');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pbplayers',function($table){
			$table->dropForeign('pbplayers_player_image_id_foreign');
			$table->dropForeign('pbplayers_player_user_id_foreign');
			$table->dropForeign('pbplayers_player_division_id_foreign');
			$table->dropColumn('player_score');

		});
	}

}
