<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsGalleries extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('albums_galleries',function($table){
			$table->integer('gallery_id')->unsigned();
			$table->foreign('gallery_id')->references('id')->on('galleries');
			$table->integer('album_fk_id')->unsigned();
			$table->foreign('album_fk_id')->references('id')->on('albums');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('albums_galleries',function($table){
			$table->dropForeign('albums_galleries_gallery_id_foreign');
			$table->dropForeign('albums_galleries_album_fk_id_foreign');
		});

		Schema::dropIfExists('albums_galleries');
	}

}
