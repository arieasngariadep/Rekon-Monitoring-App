<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNonBniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('non_bni', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_tolakan')->nullable()->index();
            $table->string('nomor_refrensi', 100)->nullable()->index();
            $table->string('rekening_debet', 100)->nullable()->index();
            $table->string('nama_pengirim', 200)->nullable()->index();
            $table->string('residency_pengirim', 50)->nullable()->index();
            $table->string('net_amount', 100)->nullable()->index();
            $table->string('pesan_pengirim', 200)->nullable()->index();
            $table->string('kode_bank', 50)->nullable()->index();
            $table->string('rek_penerima', 200)->nullable()->index();
            $table->string('nama_penerima', 200)->nullable()->index();
            $table->string('cust_name_release')->nullable()->index();
            $table->string('act_release', 50)->nullable()->index();
            $table->string('jenis_nasabah_penerima', 50)->nullable()->index();
            $table->string('residency_penerima', 50)->nullable()->index();
            $table->string('nama_bank_penerima', 100)->nullable()->index();
            $table->date('tanggal_payment')->nullable()->index();
            $table->date('tanggal_reproses_payment')->nullable()->index();
            $table->date('tanggal_settlement')->nullable()->index();
            $table->string('alasan_tolakan', 200)->nullable()->index();
            $table->string('mid', 100)->nullable()->index();
            $table->string('nama_merchant', 200)->nullable()->index();
            $table->string('status', 50)->nullable()->index();
            $table->string('jenis_transaksi', 50)->nullable()->index();
            $table->string('kode_wilayah', 10)->nullable()->index();
            $table->string('matchingkey', 80)->nullable()->unique();
            $table->foreign('kode_wilayah')->references('kode_wilayah')->on('wilayah')->onDelete('no action')->onUpdate('cascade');
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
        Schema::dropIfExists('non_bni');
    }
}
