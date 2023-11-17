<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bni', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_tolakan')->nullable()->index();
            $table->string('mid', 100)->nullable()->index();
            $table->string('nama_merchant', 200)->nullable()->index();
            $table->string('bank_name', 100)->nullable()->index();
            $table->string('cust_name', 100)->nullable()->index();
            $table->string('act_tolakan', 50)->nullable()->index();
            $table->string('settled_amt', 100)->nullable()->index();
            $table->date('tanggal_payment')->nullable()->index();
            $table->string('alasan_tolakan', 100)->nullable()->index();
            $table->date('tanggal_settlement')->nullable()->index();
            $table->string('status', 100)->nullable()->index();
            $table->string('jenis_transaksi', 50)->nullable()->index();
            $table->string('jenis_tolakan', 20)->nullable()->index();
            $table->string('kode_wilayah', 10)->nullable()->index();
            $table->string('bank_name_release', 100)->nullable()->index();
            $table->string('cust_name_release')->nullable()->index();
            $table->string('act_release', 50)->nullable()->index();
            $table->date('tanggal_reproses_payment')->nullable()->index();
            $table->string('matchingkey', 80)->nullable()->unique();
            $table->foreign('kode_wilayah')->references('kode_wilayah')->on('wilayah')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('jenis_transaksi')->references('jenis_transaksi')->on('rekening')->onDelete('no action')->onUpdate('cascade');
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
        Schema::dropIfExists('bni');
    }
}
