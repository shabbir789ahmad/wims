<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Expences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expences', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('expense_id')->nullable()->unsigned();
            $table->foreign('expense_id')->references('id')->on('expenses')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('expense');
            $table->string('name')->nullable();
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
        Schema::dropIfExists('expences');
    }
}
