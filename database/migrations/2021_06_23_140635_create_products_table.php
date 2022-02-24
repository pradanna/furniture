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
            $table->string('kodebrg')->unique();
            $table->string('barcode')->nullable();
            $table->string('kodeklmpk')->nullable();
            $table->string('kodedept')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->integer('price')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('stock')->nullable();
            $table->text('description')->nullable();
            $table->string('category')->nullable();
            $table->string('image')->nullable();
            $table->integer('hgros1')->nullable();
            $table->integer('hgros2')->nullable();
            $table->integer('quantity1')->nullable();
            $table->integer('quantity2')->nullable();
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
        Schema::dropIfExists('products');
    }
}
