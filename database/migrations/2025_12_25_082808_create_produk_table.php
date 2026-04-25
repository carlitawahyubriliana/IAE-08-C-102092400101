<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi');
            $table->string('gambar')->nullable();
            $table->integer('rating')->default(5);
            $table->integer('jumlah_terjual')->default(0);
            
            // Varian produk dengan harga
            $table->integer('harga_250gr')->nullable();
            $table->integer('harga_500gr')->nullable();
            $table->integer('harga_1kg')->nullable();
            
            // Stok per varian
            $table->integer('stok_250gr')->default(0);
            $table->integer('stok_500gr')->default(0);
            $table->integer('stok_1kg')->default(0);
            
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
        Schema::dropIfExists('produk');
    }
};
