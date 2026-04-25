<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = session('keranjang', []);
        $total = 0;
        
        foreach ($keranjang as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }
        
        return view('customer.keranjang.index', compact('keranjang', 'total'));
    }
    
    public function tambah(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'varian' => 'required|in:250gr,500gr,1kg',
            'jumlah' => 'required|integer|min:1'
        ]);
        
        $produk = Produk::findOrFail($request->produk_id);
        $varian = $request->varian;
        
        // Cek harga dan stok berdasarkan varian
        $harga = $produk->{'harga_' . $varian};
        $stok = $produk->{'stok_' . $varian};
        
        if ($stok < $request->jumlah) {
            return back()->with('error', 'Stok tidak mencukupi');
        }
        
        // Ambil keranjang dari session
        $keranjang = session('keranjang', []);
        
        // Key unik untuk produk + varian
        $key = $produk->id . '_' . $varian;
        
        // Jika sudah ada, tambah jumlahnya
        if (isset($keranjang[$key])) {
            $keranjang[$key]['jumlah'] += $request->jumlah;
        } else {
            $keranjang[$key] = [
                'produk_id' => $produk->id,
                'nama' => $produk->nama,
                'gambar' => $produk->gambar,
                'varian' => $varian,
                'harga' => $harga,
                'jumlah' => $request->jumlah
            ];
        }
        
        session(['keranjang' => $keranjang]);
        
        // Jika action adalah buy_now, redirect ke checkout
        if ($request->input('action') === 'buy_now') {
            return redirect()->route('checkout.index')->with('success', 'Produk berhasil ditambahkan ke keranjang');
        }
        
        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }
    
    public function update(Request $request, $key)
    {
        $keranjang = session('keranjang', []);
        
        if (isset($keranjang[$key])) {
            $keranjang[$key]['jumlah'] = $request->jumlah;
            session(['keranjang' => $keranjang]);
        }
        
        return redirect()->route('keranjang.index')->with('success', 'Keranjang berhasil diupdate');
    }
    
    public function hapus($key)
    {
        $keranjang = session('keranjang', []);
        
        if (isset($keranjang[$key])) {
            unset($keranjang[$key]);
            session(['keranjang' => $keranjang]);
        }
        
        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil dihapus dari keranjang');
    }
}
