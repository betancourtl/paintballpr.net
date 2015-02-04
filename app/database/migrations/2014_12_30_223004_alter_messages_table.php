<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('messages',function($table){
			$table->string('title'); //message title
			$table->integer('read'); // 0 if message is not read , 1 if message is read
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('messages',function($table){
			$table->dropColumn('title'); //delete the title column
			$table->dropColumn('read'); //delete the read column
		});
	}

}
