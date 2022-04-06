<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up() {

        Schema::create('activity_logs', function (Blueprint $table) {

         
            $table->integer('branch_id')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->integer('role_id')->nullable();
            $table->string('role')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('controller')->nullable();
            $table->string('method')->nullable();
            $table->datetime('created_at')->nullable();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down() {
        Schema::dropIfExists('activity_logs');
    }
}
