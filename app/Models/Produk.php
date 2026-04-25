<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
        'kategori',
        'rating',
        'jumlah_terjual',
        'harga_250gr',
        'harga_500gr',
        'harga_1kg',
        'stok_250gr',
        'stok_500gr',
        'stok_1kg',
    ];

    public function pesananItems()
    {
        return $this->hasMany(PesananItem::class);
    }
}
