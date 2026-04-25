<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga_250gr' => 'nullable|numeric|min:0',
            'harga_500gr' => 'nullable|numeric|min:0',
            'harga_1kg' => 'nullable|numeric|min:0',
            'stok_250gr' => 'required|numeric|min:0',
            'stok_500gr' => 'required|numeric|min:0',
            'stok_1kg' => 'required|numeric|min:0',
        ]);

        // Upload gambar
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
            'rating' => 5,
            'jumlah_terjual' => 0,
            'harga_250gr' => $request->harga_250gr,
            'harga_500gr' => $request->harga_500gr,
            'harga_1kg' => $request->harga_1kg,
            'stok_250gr' => $request->stok_250gr,
            'stok_500gr' => $request->stok_500gr,
            'stok_1kg' => $request->stok_1kg,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga_250gr' => 'nullable|numeric|min:0',
            'harga_500gr' => 'nullable|numeric|min:0',
            'harga_1kg' => 'nullable|numeric|min:0',
            'stok_250gr' => 'required|numeric|min:0',
            'stok_500gr' => 'required|numeric|min:0',
            'stok_1kg' => 'required|numeric|min:0',
        ]);

        // Update gambar jika ada file baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $produk->gambar = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga_250gr' => $request->harga_250gr,
            'harga_500gr' => $request->harga_500gr,
            'harga_1kg' => $request->harga_1kg,
            'stok_250gr' => $request->stok_250gr,
            'stok_500gr' => $request->stok_500gr,
            'stok_1kg' => $request->stok_1kg,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus gambar dari storage
        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
