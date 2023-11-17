<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomingChargebackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoming_chargeback', function (Blueprint $table) {
            $table->id();
            $table->string('matchingkey', 200)->unique()->nullable();
            $table->string('wilayah', 50)->nullable()->index();
            $table->string('id_', 15)->nullable()->index();
            $table->date('tgl_req_itr')->nullable()->index();
            $table->string('nomor_kartu', 200)->nullable()->index();
            $table->string('arn', 200)->nullable()->index();
            $table->date('trx_date')->nullable()->index();
            $table->string('amount', 200)->nullable()->index();
            $table->string('mdr', 200)->nullable()->index();
            $table->string('net_amount', 200)->nullable()->index();
            $table->string('merchant_name', 200)->nullable()->index();
            $table->string('mch_number', 200)->nullable()->index();
            $table->string('approval', 200)->nullable()->index();
            $table->string('history', 200)->nullable()->index();
            $table->string('jenis_transaksi', 200)->nullable()->index();
            $table->string('kode_jenis_trx', 5)->nullable()->index();
            $table->string('npg_cc', 200)->nullable()->index();
            $table->string('cek_bnd', 100)->nullable()->index();
            $table->string('request_incoming', 100)->nullable()->index();
            $table->date('tgl_incoming')->nullable()->index();
            $table->string('proses_incoming', 200)->nullable()->index();
            $table->string('total_nominal_hold_incoming', 200)->nullable()->index();
            $table->string('status_hold_incoming', 200)->nullable()->index();
            $table->date('tgl_info_status_cb')->nullable()->index();
            $table->string('info_status', 200)->nullable()->index();
            $table->string('proses_rkm_1', 200)->nullable()->index();
            $table->string('status_debet_merchant', 200)->nullable()->index();
            $table->string('tanggal_info_hasil_final', 200)->nullable()->index();
            $table->string('proses_rkm_2', 200)->nullable()->index();
            $table->string('final_status', 200)->nullable()->index();
            $table->foreign('cek_bnd')->references('cek_bnd')->on('info_incoming')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('request_incoming')->references('request_incoming')->on('info_incoming')->onDelete('no action')->onUpdate('cascade');
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
        Schema::dropIfExists('incoming_chargeback');
    }
}
