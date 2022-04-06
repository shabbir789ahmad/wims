<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginLogsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up() {

        Schema::create('login_logs', function (Blueprint $table) {

            $table->id();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('role_id')->nullable();
            $table->string('role')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->datetime('logged_in')->nullable();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down() {

        Schema::dropIfExists('login_logs');

    }
}
