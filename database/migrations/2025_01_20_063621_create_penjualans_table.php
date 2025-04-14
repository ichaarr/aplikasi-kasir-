<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->bigIncrements('PenjualanID'); // Primary Key
            $table->date('TanggalPenjualan'); // Tanggal Penjualan
            $table->decimal('TotalHarga', 10, 2); // Total Harga
            $table->unsignedBigInteger('PelangganID'); // Foreign Key ke Pelanggan
            $table->timestamps(); // Timestamps (created_at & updated_at)

            // Menambahkan foreign key yang mengarah ke tabel pelanggans
            $table->foreign('PelangganID')->references('PelangganID')->on('pelanggans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualans');
    }
}