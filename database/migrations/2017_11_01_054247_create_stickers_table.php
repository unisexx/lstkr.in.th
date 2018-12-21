<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stickers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sticker_code');
            $table->string('name', 250);
            $table->text('description');
            $table->string('head_credit', 100);
            $table->string('foot_credit', 100);
            $table->integer('user_id');
            $table->tinyInteger('status');
            $table->tinyInteger('version');
            $table->tinyInteger('hasanimation');
            $table->tinyInteger('hassound');
            $table->string('stickerresourcetype',20);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stickers');
    }
}
