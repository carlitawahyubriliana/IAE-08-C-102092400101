<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'user_id',
        'nama_penerima',
        'no_telp',
        'alamat_lengkap',
        'kota',
        'provinsi',
        'kode_pos',
        'patokan',
        'kurir',
        'layanan_kurir',
        'biaya_pengiriman',
        'resi',
        'subtotal_produk',
        'biaya_penanganan',
        'total_pembayaran',
        'status',
        'status_pembayaran',
        'metode_pembayaran',
        'bukti_pembayaran',
        'catatan',
        'tanggal_pesanan',
    ];

    protected $casts = [
        'tanggal_pesanan' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(PesananItem::class);
    }
}
