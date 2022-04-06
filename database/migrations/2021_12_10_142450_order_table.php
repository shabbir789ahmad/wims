<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
             $table->id();
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('product_name');
            $table->string('sell');
            $table->string('quentity');
            $table->string('sub_total');
            $table->string('tax')->default(0)->nullable();
             $table->string('type')->nullable();
            $table->string('unit');
            $table->bigInteger('payment_id')->nullable()->unsigned();
            $table->foreign('payment_id')->references('id')->on('payments')->onUpdate('cascade')->onDelete('cascade');
           $table->bigInteger('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade')->onUpdate('cascade');
            $table->datetime('deleted_at')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
