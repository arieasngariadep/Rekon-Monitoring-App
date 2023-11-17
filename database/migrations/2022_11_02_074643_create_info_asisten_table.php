<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoAsistenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_asisten', function (Blueprint $table) {
            $table->id();
            $table->string('proses_incoming', 100)->nullable()->index();
            $table->string('info_status', 100)->nullable()->index();
            $table->string('proses_rkm_1', 200)->nullable()->index();
            $table->string('final_status', 50)->nullable()->index();
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
        Schema::dropIfExists('info_asisten');
    }
}
