<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\PesananItem;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PesananApiController extends Controller
{
    /**
     * Menampilkan semua pesanan milik user yang login
     */
    public function index()
    {
        $user = Auth::user();
        
        $pesanan = Pesanan::where('user_id', $user->id)
            ->with('items')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data pesanan berhasil diambil',
            'data' => $pesanan
        ], 200);
    }

    /**
     * Membuat pesanan baru
     * 
     * Request body:
     * {
     *   "nama_penerima": "string",
     *   "no_telp": "string",
     *   "alamat_lengkap": "string",
     *   "kota": "string",
     *   "provinsi": "string",
     *   "kode_pos": "string",
     *   "patokan": "string (opsional)",
     *   "kurir": "string",
     *   "layanan_kurir": "string",
     *   "biaya_pengiriman": "numeric",
     *   "metode_pembayaran": "string",
     *   "catatan": "string (opsional)",
     *   "items": [
     *     {
     *       "produk_id": "integer",
     *       "jumlah": "integer",
     *       "varian": "string (opsional)"
     *     }
     *   ]
     * }
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_penerima' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'alamat_lengkap' => 'required|string',
            'kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:10',
            'kurir' => 'required|string|max:50',
            'layanan_kurir' => 'required|string|max:100',
            'biaya_pengiriman' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|string|max:50',
            'patokan' => 'nullable|string',
            'catatan' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.produk_id' => 'required|integer|exists:produk,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'items.*.varian' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = Auth::user();
            
            // Hitung subtotal produk dan validasi stok
            $subtotal_produk = 0;
            $items_data = [];
            
            foreach ($request->items as $item) {
                $produk = Produk::find($item['produk_id']);
                
                if (!$produk) {
                    return response()->json([
                        'status' => 'error',
                        'message' => "Produk dengan ID {$item['produk_id']} tidak ditemukan"
                    ], 404);
                }
                
                if ($produk->stok < $item['jumlah']) {
                    return response()->json([
                        'status' => 'error',
                        'message' => "Stok {$produk->nama_produk} tidak cukup. Tersedia: {$produk->stok}, diminta: {$item['jumlah']}"
                    ], 400);
                }
                
                $subtotal = $produk->harga * $item['jumlah'];
                $subtotal_produk += $subtotal;
                
                $items_data[] = [
                    'produk_id' => $produk->id,
                    'nama_produk' => $produk->nama_produk,
                    'harga_satuan' => $produk->harga,
                    'jumlah' => $item['jumlah'],
                    'varian' => $item['varian'] ?? null,
                    'subtotal' => $subtotal
                ];
            }
            
            // Hitung biaya penanganan (misalnya 5% dari subtotal produk)
            $biaya_penanganan = ceil($subtotal_produk * 0.05);
            $total_pembayaran = $subtotal_produk + $biaya_penanganan + $request->biaya_pengiriman;
            
            // Buat pesanan
            $pesanan = Pesanan::create([
                'user_id' => $user->id,
                'nama_penerima' => $request->nama_penerima,
                'no_telp' => $request->no_telp,
                'alamat_lengkap' => $request->alamat_lengkap,
                'kota' => $request->kota,
                'provinsi' => $request->provinsi,
                'kode_pos' => $request->kode_pos,
                'patokan' => $request->patokan,
                'kurir' => $request->kurir,
                'layanan_kurir' => $request->layanan_kurir,
                'biaya_pengiriman' => $request->biaya_pengiriman,
                'subtotal_produk' => $subtotal_produk,
                'biaya_penanganan' => $biaya_penanganan,
                'total_pembayaran' => $total_pembayaran,
                'metode_pembayaran' => $request->metode_pembayaran,
                'catatan' => $request->catatan,
                'status' => 'pending',
                'status_pembayaran' => 'unpaid',
                'tanggal_pesanan' => now()
            ]);
            
            // Buat pesanan items
            foreach ($items_data as $item) {
                PesananItem::create([
                    'pesanan_id' => $pesanan->id,
                    ...$item
                ]);
            }
            
            // Reload pesanan dengan items
            $pesanan->load('items');
            
            return response()->json([
                'status' => 'success',
                'message' => 'Pesanan berhasil dibuat',
                'data' => $pesanan
            ], 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat membuat pesanan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
