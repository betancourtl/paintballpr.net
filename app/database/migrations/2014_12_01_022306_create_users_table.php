<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users',function($table){
			$table->increments('id');
			$table->string('email','50')->unique();
			$table->string('username','60')->unique();
			$table->string('first_name','25');
			$table->string('last_name','25');
			$table->string('cell');
			$table->string('password','60');
			$table->string('password_temp','60');
			$table->string('code','60');
			$table->integer('active');
			$table->rememberToken();
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
		Schema::dropIfExists('users');
	}

}

