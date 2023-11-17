<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 150)->nullable();
            $table->string('email', 150)->unique()->nullable();
            $table->string('password', 200)->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('kelompok_id')->nullable();
            $table->foreign('role_id')->references('role_id')->on('role')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kelompok_id')->references('id')->on('kelompok')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('users');
    }
}
