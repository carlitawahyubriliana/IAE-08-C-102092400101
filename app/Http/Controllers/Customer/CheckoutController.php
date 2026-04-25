<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\PesananItem;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $keranjang = session('keranjang', []);
        
        if (empty($keranjang)) {
            return redirect()->route('home')->with('error', 'Keranjang belanja kosong');
        }
        
        $subtotal = 0;
        foreach ($keranjang as $item) {
            $subtotal += $item['harga'] * $item['jumlah'];
        }
        
        // Biaya default
        $biayaPengiriman = 15000;
        $biayaPenanganan = 5000;
        $total = $subtotal + $biayaPengiriman + $biayaPenanganan;
        
        return view('customer.checkout.index', compact('keranjang', 'subtotal', 'biayaPengiriman', 'biayaPenanganan', 'total'));
    }
    
    public function proses(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'kode_pos' => 'required|string|max:10',
            'alamat_lengkap' => 'required|string',
            'patokan' => 'nullable|string',
            'kurir' => 'required|string',
            'layanan_kurir' => 'required|string',
            'metode_pembayaran' => 'required|string',
            'bukti_pembayaran' => 'nullable|image|max:2048'
        ]);
        
        $keranjang = session('keranjang', []);
        
        if (empty($keranjang)) {
            return redirect()->route('home')->with('error', 'Keranjang belanja kosong');
        }
        
        DB::beginTransaction();
        
        try {
            // Hitung total
            $subtotal = 0;
            foreach ($keranjang as $item) {
                $subtotal += $item['harga'] * $item['jumlah'];
            }
            
            $biayaPengiriman = 15000;
            $biayaPenanganan = 5000;
            $total = $subtotal + $biayaPengiriman + $biayaPenanganan;
            
            // Upload bukti pembayaran jika ada
            $buktiPath = null;
            if ($request->hasFile('bukti_pembayaran')) {
                $buktiPath = $request->file('bukti_pembayaran')->store('pembayaran', 'public');
            }
            
            // Buat pesanan
            $pesanan = Pesanan::create([
                'user_id' => auth()->id(),
                'tanggal_pesanan' => now(),
                'nama_penerima' => $request->nama_penerima,
                'no_telp' => $request->no_telp,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'kode_pos' => $request->kode_pos,
                'alamat_lengkap' => $request->alamat_lengkap,
                'patokan' => $request->patokan,
                'kurir' => $request->kurir,
                'layanan_kurir' => $request->layanan_kurir,
                'biaya_pengiriman' => $biayaPengiriman,
                'subtotal_produk' => $subtotal,
                'biaya_penanganan' => $biayaPenanganan,
                'total_pembayaran' => $total,
                'status' => 'pending',
                'status_pembayaran' => $buktiPath ? 'sudah_bayar' : 'belum_bayar',
                'metode_pembayaran' => $request->metode_pembayaran,
                'bukti_pembayaran' => $buktiPath
            ]);
            
            // Simpan item pesanan dan kurangi stok
            foreach ($keranjang as $item) {
                PesananItem::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id' => $item['produk_id'],
                    'nama_produk' => $item['nama'],
                    'varian' => $item['varian'],
                    'harga_satuan' => $item['harga'],
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $item['harga'] * $item['jumlah']
                ]);
                
                // Kurangi stok
                $produk = Produk::find($item['produk_id']);
                $stokField = 'stok_' . $item['varian'];
                $produk->$stokField -= $item['jumlah'];
                $produk->save();
            }
            
            DB::commit();
            
            // Hapus keranjang
            session()->forget('keranjang');
            
            return redirect()->route('customer.pesanan.show', $pesanan->id)
                ->with('success', 'Pesanan berhasil dibuat!');
            
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
