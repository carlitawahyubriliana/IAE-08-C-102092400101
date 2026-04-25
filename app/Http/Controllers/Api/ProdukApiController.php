<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk; // Pastikan model Produk sudah ada
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProdukApiController extends Controller
{
    /**
     * -----------------------------------------------------
     * BAGIAN PUBLIK & CUSTOMER
     * -----------------------------------------------------
     */

    // Menampilkan semua data produk (Bisa untuk katalog publik)
    public function index()
    {
        // Mengambil semua produk, bisa ditambahkan pagination (misal: paginate(10))
        $produk = Produk::all(); 

        return response()->json([
            'status' => 'success',
            'message' => 'Data produk berhasil diambil',
            'data' => $produk
        ], 200);
    }

    // Menampilkan detail satu produk berdasarkan ID
    public function show($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail produk berhasil diambil',
            'data' => $produk
        ], 200);
    }


    /**
     * -----------------------------------------------------
     * BAGIAN ADMIN (Butuh Token & Role Admin)
     * -----------------------------------------------------
     */

    // Menambah produk baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            // Jika ada gambar: 'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $produk = Produk::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil ditambahkan',
            'data' => $produk
        ], 201);
    }

    // Mengupdate data produk
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_produk' => 'sometimes|required|string|max:255',
            'harga' => 'sometimes|required|numeric|min:0',
            'stok' => 'sometimes|required|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $produk->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil diupdate',
            'data' => $produk
        ], 200);
    }

    // Menghapus produk
    public function destroy($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        $produk->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil dihapus'
        ], 200);
    }
}