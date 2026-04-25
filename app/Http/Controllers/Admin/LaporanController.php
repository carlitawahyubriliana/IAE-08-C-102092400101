<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Filter periode
        $periode = $request->get('periode', 'bulan_ini');
        
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();
        
        switch ($periode) {
            case 'hari_ini':
                $startDate = now()->startOfDay();
                $endDate = now()->endOfDay();
                break;
            case 'minggu_ini':
                $startDate = now()->startOfWeek();
                $endDate = now()->endOfWeek();
                break;
            case 'bulan_lalu':
                $startDate = now()->subMonth()->startOfMonth();
                $endDate = now()->subMonth()->endOfMonth();
                break;
            case 'tahun_ini':
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                break;
        }
        
        // Statistik Umum
        $totalPenjualan = Pesanan::where('status_pembayaran', 'sudah_bayar')
            ->whereBetween('tanggal_pesanan', [$startDate, $endDate])
            ->sum('total_pembayaran');
        
        $totalPesanan = Pesanan::whereBetween('tanggal_pesanan', [$startDate, $endDate])
            ->count();
        
        $pesananSelesai = Pesanan::where('status', 'selesai')
            ->whereBetween('tanggal_pesanan', [$startDate, $endDate])
            ->count();
        
        $customerBaru = User::where('role', 'customer')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
        
        // Produk Terlaris
        $produkTerlaris = DB::table('pesanan_items')
            ->join('pesanan', 'pesanan_items.pesanan_id', '=', 'pesanan.id')
            ->join('produk', 'pesanan_items.produk_id', '=', 'produk.id')
            ->select(
                'produk.id',
                'produk.nama',
                'pesanan_items.varian',
                DB::raw('SUM(pesanan_items.jumlah) as total_terjual'),
                DB::raw('SUM(pesanan_items.subtotal) as total_pendapatan')
            )
            ->where('pesanan.status_pembayaran', 'sudah_bayar')
            ->whereBetween('pesanan.tanggal_pesanan', [$startDate, $endDate])
            ->groupBy('produk.id', 'produk.nama', 'pesanan_items.varian')
            ->orderBy('total_terjual', 'desc')
            ->limit(10)
            ->get();
        
        // Penjualan Harian (7 hari terakhir untuk grafik)
        $penjualanHarian = Pesanan::select(
                DB::raw('DATE(tanggal_pesanan) as tanggal'),
                DB::raw('COUNT(*) as jumlah_pesanan'),
                DB::raw('SUM(total_pembayaran) as total')
            )
            ->where('status_pembayaran', 'sudah_bayar')
            ->whereBetween('tanggal_pesanan', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        
        // Kategori Terlaris
        $kategoriTerlaris = DB::table('pesanan_items')
            ->join('pesanan', 'pesanan_items.pesanan_id', '=', 'pesanan.id')
            ->join('produk', 'pesanan_items.produk_id', '=', 'produk.id')
            ->select(
                'produk.kategori',
                DB::raw('SUM(pesanan_items.jumlah) as total_terjual'),
                DB::raw('SUM(pesanan_items.subtotal) as total_pendapatan')
            )
            ->where('pesanan.status_pembayaran', 'sudah_bayar')
            ->whereBetween('pesanan.tanggal_pesanan', [$startDate, $endDate])
            ->groupBy('produk.kategori')
            ->orderBy('total_terjual', 'desc')
            ->get();
        
        return view('admin.laporan.index', compact(
            'totalPenjualan',
            'totalPesanan',
            'pesananSelesai',
            'customerBaru',
            'produkTerlaris',
            'penjualanHarian',
            'kategoriTerlaris',
            'periode',
            'startDate',
            'endDate'
        ));
    }
}
