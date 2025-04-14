<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id('ProdukID');
            $table->string('NamaProduk', 255)->nullable();
            $table->string('Nama', 255)->nullable();
            $table->decimal('Harga', 10, 2);
            $table->integer('Stok');
            $table->unsignedBigInteger('KategoriID');
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
        Schema::dropIfExists('produks');
    }
}
