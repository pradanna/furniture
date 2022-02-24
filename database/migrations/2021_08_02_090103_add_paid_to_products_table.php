<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaidToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 'diskon',
        // 'pot_harga',
        // 'price',
        // 'hgros1',
        // 'hgros2',
        // 'batas_promo',
        // 'is_active',
        Schema::table('products', function (Blueprint $table) {
            $table->string('is_promo')->nullable()->default('tidak');
            $table->string('discount')->nullable();
            $table->integer('potongan_harga')->nullable();
            $table->integer('d_price')->nullable();
            $table->integer('d_hgros1')->nullable();
            $table->integer('d_hgros2')->nullable();
            $table->string('expired')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
