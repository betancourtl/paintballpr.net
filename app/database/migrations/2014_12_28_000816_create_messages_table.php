<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages',function($table){
			$table->increments('id');
			$table->integer('user_from')->unsigned();
			$table->integer('user_to')->unsigned();
			$table->text('message');
			$table->foreign('user_from')->references('id')->on('users');
			$table->foreign('user_to')->references('id')->on('users');
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
		Schema::drop('messages');
	}

}
