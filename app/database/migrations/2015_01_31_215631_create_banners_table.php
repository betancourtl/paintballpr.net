<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function ($table)
        {
            $table->increments('id');
            $table->string('banner_name');
            $table->string('banner_description');
            $table->string('begin_date');
            $table->string('end_date');
            $table->integer('default_banner_image');
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
        Schema::dropIfExists('banners');
    }

}
