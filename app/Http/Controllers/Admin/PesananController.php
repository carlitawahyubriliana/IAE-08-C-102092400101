<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pesanan::with(['user', 'items.produk'])->orderBy('created_at', 'desc');

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan status pembayaran
        if ($request->has('status_pembayaran') && $request->status_pembayaran != '') {
            $query->where('status_pembayaran', $request->status_pembayaran);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_penerima', 'like', "%{$search}%")
                  ->orWhere('no_telp', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%");
            });
        }

        $pesanan = $query->paginate(15);
        
        return view('admin.pesanan.index', compact('pesanan'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pesanan = Pesanan::with(['user', 'items.produk'])->findOrFail($id);
        return view('admin.pesanan.show', compact('pesanan'));
    }

    /**
     * Update status pesanan
     */
    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,dikonfirmasi,diproses,dikirim,selesai,dibatalkan',
        ]);

        $pesanan->status = $request->status;

        // Jika status dikirim, tambahkan resi
        if ($request->status == 'dikirim' && $request->has('resi')) {
            $pesanan->resi = $request->resi;
        }

        $pesanan->save();

        return back()->with('success', 'Status pesanan berhasil diupdate!');
    }

    /**
     * Update status pembayaran
     */
    public function updatePembayaran(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $request->validate([
            'status_pembayaran' => 'required|in:belum_bayar,sudah_bayar',
        ]);

        $pesanan->status_pembayaran = $request->status_pembayaran;
        $pesanan->save();

        return back()->with('success', 'Status pembayaran berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        
        // Hapus bukti pembayaran jika ada
        if ($pesanan->bukti_pembayaran && \Storage::disk('public')->exists($pesanan->bukti_pembayaran)) {
            \Storage::disk('public')->delete($pesanan->bukti_pembayaran);
        }

        $pesanan->delete();

        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil dihapus!');
    }
}
