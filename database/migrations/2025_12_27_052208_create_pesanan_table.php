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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            
            // Data pengiriman
            $table->string('nama_penerima');
            $table->string('no_telp');
            $table->text('alamat_lengkap');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('kode_pos');
            $table->text('patokan')->nullable();
            
            // Data pengiriman
            $table->string('kurir'); // JNT Express, JNE, dll
            $table->string('layanan_kurir'); // Regular, Express, dll
            $table->integer('biaya_pengiriman');
            $table->string('resi')->nullable();
            
            // Rincian biaya
            $table->integer('subtotal_produk');
            $table->integer('biaya_penanganan')->default(1000);
            $table->integer('total_pembayaran');
            
            // Status pesanan
            $table->enum('status', ['pending', 'dikonfirmasi', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('pending');
            $table->enum('status_pembayaran', ['belum_bayar', 'sudah_bayar'])->default('belum_bayar');
            
            // Metode pembayaran
            $table->string('metode_pembayaran')->nullable(); // Transfer, COD, dll
            $table->string('bukti_pembayaran')->nullable();
            
            $table->text('catatan')->nullable();
            $table->timestamp('tanggal_pesanan')->useCurrent();
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
        Schema::dropIfExists('pesanan');
    }
};
