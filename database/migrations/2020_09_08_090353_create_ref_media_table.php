<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_media', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('media_id')->index();
            $table->string('reference_module');
            $table->unsignedBigInteger('reference_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_media');
    }
}
