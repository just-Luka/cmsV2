<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translation_trans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('translation_id'); //key id
            $table->foreign('translation_id')->references('id')->on('translation')->onDelete('cascade');
            $table->char('lang_slug')->index();
            $table->string('means');
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
        Schema::dropIfExists('translation_trans');
    }
}
