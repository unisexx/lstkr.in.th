<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->increments('id');
			$table->string('theme_code',100);
			$table->string('name', 250);
			$table->text('description');
			$table->string('price', 10);
			$table->integer('user_id');
            $table->string('head_credit', 100);
            $table->string('foot_credit', 100);
			$table->tinyInteger('status');
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
        Schema::drop('themes');
    }
}
