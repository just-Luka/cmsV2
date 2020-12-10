<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_tag', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('attached_to');
            $table->unsignedBigInteger('attachment_id');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->unsignedBigInteger('tag_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_tag');
    }
}
