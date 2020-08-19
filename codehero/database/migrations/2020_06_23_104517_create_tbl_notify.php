<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblNotify extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notify', function (Blueprint $table) {
            $table->increments('id_notify');
            $table->string('content_notify');
            $table->integer('id_send');
            $table->integer('id_blog');
            $table->integer('id_forum');
            $table->integer('id_cmt');
            $table->integer('id_rec');
            $table->integer('type_notify');
            $table->integer('status_notify');
            $table->string('link_notify');
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
        Schema::dropIfExists('notify');
    }
}
