<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoIncomingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_incoming', function (Blueprint $table) {
            $table->id();
            $table->string('cek_bnd', 100)->nullable()->index();
            $table->string('request_incoming', 100)->nullable()->index();
            $table->string('proses_incoming', 200)->nullable()->index();
            $table->integer('kode_jenis_trx')->nullable()->index();
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
        Schema::dropIfExists('info_incoming');
    }
}
