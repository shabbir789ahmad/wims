<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up() {

        Schema::create('sub_categories', function (Blueprint $table) {

            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('sub_category_name');
            $table->bigInteger('admin_id')->nullable()->unsigned();
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

        Schema::dropIfExists('sub_categories');
        
    }
}
