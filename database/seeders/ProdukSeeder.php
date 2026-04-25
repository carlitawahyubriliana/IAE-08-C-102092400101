<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produk = [
            [
                'nama' => 'Jamur Tiram Putih',
                'deskripsi' => 'Jamur tiram putih segar dengan kualitas terbaik. Kaya akan protein, serat, dan rendah kalori. Cocok untuk berbagai masakan seperti tumis, sup, atau goreng tepung.',
                'gambar' => 'produk/placeholder.jpg',
                'rating' => 5,
                'jumlah_terjual' => 450,
                'harga_250gr' => 6000,
                'harga_500gr' => 10000,
                'harga_1kg' => 17000,
                'stok_250gr' => 50,
                'stok_500gr' => 40,
                'stok_1kg' => 30,
            ],
            [
                'nama' => 'Jamur Tiram Coklat',
                'deskripsi' => 'Jamur tiram coklat dengan tekstur yang lebih kenyal dan rasa yang lebih kuat. Memberikan profil rasa yang lebih "berdaging", menjadikannya pengganti daging yang populer dan sempurna untuk semur.',
                'gambar' => 'produk/placeholder.jpg',
                'rating' => 5,
                'jumlah_terjual' => 200,
                'harga_250gr' => 6000,
                'harga_500gr' => 10000,
                'harga_1kg' => 17000,
                'stok_250gr' => 45,
                'stok_500gr' => 35,
                'stok_1kg' => 25,
            ],
            [
                'nama' => 'Jamur Kuping',
                'deskripsi' => 'Jamur kuping premium dengan tekstur renyah dan kaya akan nutrisi. Sangat baik untuk kesehatan jantung dan mengandung antioksidan tinggi. Cocok untuk capcay, sup, dan tumisan.',
                'gambar' => 'produk/placeholder.jpg',
                'rating' => 5,
                'jumlah_terjual' => 285,
                'harga_250gr' => 8000,
                'harga_500gr' => 15000,
                'harga_1kg' => 28000,
                'stok_250gr' => 30,
                'stok_500gr' => 25,
                'stok_1kg' => 20,
            ],
            [
                'nama' => 'Jamur Kancing',
                'deskripsi' => 'Jamur kancing segar berkualitas premium. Memiliki tekstur lembut dan rasa yang mild. Sempurna untuk salad, pizza, pasta, soup, dan berbagai masakan western maupun oriental.',
                'gambar' => 'produk/placeholder.jpg',
                'rating' => 5,
                'jumlah_terjual' => 150,
                'harga_250gr' => 12000,
                'harga_500gr' => 22000,
                'harga_1kg' => 40000,
                'stok_250gr' => 35,
                'stok_500gr' => 30,
                'stok_1kg' => 20,
            ],
        ];

        foreach ($produk as $item) {
            Produk::create($item);
        }

        echo "✅ Berhasil membuat " . count($produk) . " produk!\n";
    }
}
