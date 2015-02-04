<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTeamsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pbteams',function($table){
			$table->integer('division_id')->unsigned();
			$table->foreign('division_id')->references('id')->on('pbdivisions');
			$table->string('team_password');
	});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pbteams',function($table){
			$table->dropForeign('pbteams_division_id_foreign');
			$table->dropColumn('team_password');

		});
	}

}
