<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldsafTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holdsaf', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_hold')->nullable()->index();
            $table->string('mid', 100)->nullable()->index();
            $table->string('nama_merchant', 200)->nullable()->index();
            $table->string('no_kartu', 20)->nullable()->index();
            $table->string('nominal', 100)->nullable()->index();
            $table->string('apprvl', 10)->nullable()->index();
            $table->string('nama_bank', 100)->nullable()->index();
            $table->string('cust_name', 100)->nullable()->index();
            $table->string('act_hold', 20)->nullable()->index();
            $table->string('settled_amt', 100)->nullable()->index();
            $table->string('hold_amt', 20)->nullable()->index();
            $table->string('mdr', 10)->nullable()->index();
            $table->string('disc_amt', 100)->nullable()->index();
            $table->string('net_hold',100)->nullable()->index();
            $table->string('paid_amt', 100)->nullable()->index();
            $table->date('tanggal_release')->nullable()->index();
            $table->string('released_by',50)->nullable()->index();
            $table->foreign('released_by')->references('released_by')->on('releasedby')->onDelete('no action')->onUpdate('cascade');
            $table->string('alasan_hold', 100)->nullable()->index();
            $table->string('alasan_release', 100)->nullable()->index();
            $table->string('matchingkey', 100)->nullable()->unique();
            $table->string('kode_wilayah', 10)->nullable()->index();
            $table->string('jenis_transaksi', 50)->nullable()->index();
            $table->foreign('kode_wilayah')->references('kode_wilayah')->on('wilayah')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('jenis_transaksi')->references('jenis_transaksi')->on('rekening')->onDelete('no action')->onUpdate('cascade');
            $table->string('status', 100)->nullable()->index();
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
        Schema::dropIfExists('holdsaf');
    }
}
