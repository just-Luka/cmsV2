<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('redirect')->nullable();
            $table->boolean('visible')->nullable();
            $table->string('position')->nullable();
            $table->integer('sort');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('attachment')->nullable();
            $table->unsignedBigInteger('attachment_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
