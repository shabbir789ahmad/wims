<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('biller_name');
            $table->string('paying_by')->nullable();
            $table->string('paying_amount')->nullable();
            $table->string('payable_amount');
            $table->string('sale_note')->nullable();
            $table->string('staff_note')->nullable();
            $table->string('discount')->nullable();
            $table->string('tax')->nullable();
            
            $table->string('customer_name')->nullable();
            $table->bigInteger('customer_id')->nullable()->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade')->onUpdate('cascade');
             $table->bigInteger('admin_id')->nullable()->unsigned();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('payments');
    }
}
