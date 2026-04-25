<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'customer');
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        $customers = $query->withCount(['pesanan'])
            ->latest()
            ->paginate(10);
        
        $stats = [
            'total' => User::where('role', 'customer')->count(),
            'aktif' => User::where('role', 'customer')
                ->whereHas('pesanan', function($q) {
                    $q->where('created_at', '>=', now()->subMonth());
                })
                ->count(),
        ];
        
        return view('admin.customer.index', compact('customers', 'stats'));
    }
    
    public function show($id)
    {
        $customer = User::where('role', 'customer')
            ->with(['pesanan' => function($q) {
                $q->latest();
            }])
            ->findOrFail($id);
        
        $stats = [
            'total_pesanan' => $customer->pesanan->count(),
            'total_belanja' => $customer->pesanan->where('status_pembayaran', 'sudah_bayar')->sum('total_pembayaran'),
            'pesanan_selesai' => $customer->pesanan->where('status', 'selesai')->count(),
        ];
        
        return view('admin.customer.show', compact('customer', 'stats'));
    }
    
    public function destroy($id)
    {
        $customer = User::where('role', 'customer')->findOrFail($id);
        
        // Cek apakah customer memiliki pesanan
        if ($customer->pesanan()->count() > 0) {
            return redirect()->route('admin.customer.index')
                ->with('error', 'Tidak dapat menghapus customer yang memiliki riwayat pesanan');
        }
        
        $customer->delete();
        
        return redirect()->route('admin.customer.index')
            ->with('success', 'Customer berhasil dihapus');
    }
}
