<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up() {

        Schema::create('units', function (Blueprint $table) {

            $table->id();
            $table->string('unit_name', 10);
            $table->string('unit_code', 10);
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
    public function down() {

        Schema::dropIfExists('units');

    }
}
