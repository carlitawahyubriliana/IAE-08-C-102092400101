<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        $produkLainnya = Produk::where('id', '!=', $id)->get();
        return view('customer.produk.show', compact('produk', 'produkLainnya'));
    }
}
