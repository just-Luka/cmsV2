<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_trans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->unsignedBigInteger('menu_id'); //key id
            $table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade');
            $table->char('lang_slug')->index();
            $table->foreign('lang_slug')->references('lang')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_trans');
    }
}
