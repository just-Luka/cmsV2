<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_trans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('content')->nullable();
            $table->unsignedBigInteger('banner_id'); //key id
            $table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');
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
        Schema::dropIfExists('banner_trans');
    }
}
