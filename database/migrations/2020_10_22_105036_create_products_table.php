<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('slug');
            $table->float('price')->nullable();
            $table->float('new_price')->nullable();
            $table->string('image')->nullable();
            $table->string('second_image')->nullable();
            $table->integer('sort')->nullable();
            $table->boolean('visible')->nullable();
            $table->string('brand')->nullable();
            $table->float('fake_rating')->nullable();
            $table->float('fake_star')->nullable();
            $table->integer('fake_sold')->nullable();
            $table->boolean('on_main')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
