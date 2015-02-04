<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('album_tags',function($table){
			$table->integer('tag_id')->unsigned();
			$table->foreign('tag_id')->references('id')->on('tags');
			$table->integer('subtag_id')->unsigned();
			$table->foreign('subtag_id')->references('id')->on('subtags');
			$table->integer('album_id')->unsigned();
			$table->foreign('album_id')->references('id')->on('albums');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('album_tags',function($table){
			$table->dropForeign('album_tags_tag_id_foreign');
			$table->dropForeign('album_tags_subtag_id_foreign');
			$table->dropForeign('album_tags_album_id_foreign');
		});

		Schema::dropIfExists('album_tags');
	}

}
