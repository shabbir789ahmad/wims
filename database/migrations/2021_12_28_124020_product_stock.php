<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::create('product_stocks', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('pbrand_id')->unsigned();
            $table->foreign('pbrand_id')->references('id')->on('product_brands')->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('stock');
            $table->bigInteger('stock_sold')->nullable();
            $table->bigInteger('stock_sold_kg')->nullable();
            $table->bigInteger('stock_sold_gram')->nullable();
            $table->string('product_price_piece')->nullable();
            $table->string('product_price_unit')->nullable();
            $table->string('product_price_piece_wholesale')->nullable();
            $table->string('product_price_unit_wholesale')->nullable();
            $table->string('purchasing_price');
            $table->string('active');
            $table->bigInteger('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('product_stocks');
    }
}
