<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credentials', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');
            $table->bigInteger('admin_id')->nullable()->unsigned();
           $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('credentials');
    }
}
