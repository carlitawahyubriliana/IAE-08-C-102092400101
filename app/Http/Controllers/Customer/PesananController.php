<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::where('user_id', auth()->id())
            ->with('items')
            ->latest()
            ->paginate(10);
        
        return view('customer.pesanan.index', compact('pesanan'));
    }
    
    public function show($id)
    {
        $pesanan = Pesanan::where('user_id', auth()->id())
            ->with(['items.produk', 'user'])
            ->findOrFail($id);
        
        return view('customer.pesanan.show', compact('pesanan'));
    }
}
