<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up() {

        Schema::create('products', function (Blueprint $table) {

            $table->id();
            
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('sub_category_id')->constrained()->onDelete('cascade');
            $table->string('product_name');
            $table->string('product_code')->nullable();
            $table->string('gst_tax')->nullable();
            $table->string('product_weight')->nullable();
            $table->string('unit_barcode')->nullable();
            $table->string('pack_quentity')->nullable();
            $table->foreignId('unit_id')->constrained()->onDelete('cascade');
            $table->string('sell_by');
            $table->string('product_image')->nullable();
            $table->timestamps();
            
              $table->bigInteger('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade')->onUpdate('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down() {

        Schema::dropIfExists('products');

    }
}
