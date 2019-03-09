<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->integer('id_film');
            $table->string('nama_lengkap',80);
            $table->double('no_ktp');
            $table->date('tgl_pinjam',20);
            $table->date('tgl_kembali',20);
            $table->double('harga_sewa');
            $table->string('status',50);
            $table->timestamp('waktu_posting');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
