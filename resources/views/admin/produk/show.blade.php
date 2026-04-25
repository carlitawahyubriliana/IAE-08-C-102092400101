<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: #f5f5f5;
        }

        .navbar {
            background: #0d4d4d;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar h1 {
            font-size: 20px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            transition: opacity 0.3s;
        }

        .navbar a:hover {
            opacity: 0.8;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .product-header {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .product-img {
            width: 100%;
            border-radius: 10px;
            border: 2px solid #e0e0e0;
        }

        .product-info h2 {
            color: #0d4d4d;
            margin-bottom: 15px;
        }

        .badge {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .badge-tiram_putih {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .badge-tiram_coklat {
            background: #efebe9;
            color: #5d4037;
        }

        .badge-kuping {
            background: #fce4ec;
            color: #c2185b;
        }

        .badge-kancing {
            background: #fff3e0;
            color: #e65100;
        }

        .info-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #666;
            width: 150px;
        }

        .info-value {
            color: #333;
            flex: 1;
        }

        .section-title {
            color: #0d4d4d;
            font-size: 18px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #0d4d4d;
        }

        .varian-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 15px;
        }

        .varian-card {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }

        .varian-card .label {
            font-weight: 600;
            color: #666;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .varian-card .price {
            font-size: 20px;
            font-weight: bold;
            color: #0d4d4d;
            margin-bottom: 5px;
        }

        .varian-card .stock {
            font-size: 14px;
            color: #666;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: all 0.3s;
            margin-right: 10px;
        }

        .btn-warning {
            background: #f39c12;
            color: white;
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .actions {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f0f0f0;
        }

        @media (max-width: 768px) {
            .product-header {
                grid-template-columns: 1fr;
            }

            .varian-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>🍄 Detail Produk</h1>
        <div>
            <a href="{{ route('admin.produk.index') }}">← Kembali</a>
        </div>
    </nav>

    <div class="container">
        <div class="card">
            <div class="product-header">
                <div>
                    @if($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}" class="product-img">
                    @else
                        <div class="product-img" style="background: #ddd; height: 300px;"></div>
                    @endif
                </div>
                <div class="product-info">
                    <h2>{{ $produk->nama }}</h2>
                    
                    <div class="info-row">
                        <div class="info-label">Rating</div>
                        <div class="info-value">⭐ {{ $produk->rating }}/5</div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Jumlah Terjual</div>
                        <div class="info-value">{{ $produk->jumlah_terjual }} produk</div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Dibuat</div>
                        <div class="info-value">{{ $produk->created_at->format('d M Y, H:i') }}</div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Terakhir Update</div>
                        <div class="info-value">{{ $produk->updated_at->format('d M Y, H:i') }}</div>
                    </div>
                </div>
            </div>

            <div style="margin-bottom: 30px;">
                <h3 class="section-title">Deskripsi Produk</h3>
                <p style="color: #666; line-height: 1.6;">{{ $produk->deskripsi }}</p>
            </div>

            <div>
                <h3 class="section-title">Harga & Stok per Varian</h3>
                <div class="varian-grid">
                    <div class="varian-card">
                        <div class="label">250 Gram</div>
                        <div class="price">
                            @if($produk->harga_250gr)
                                Rp {{ number_format($produk->harga_250gr, 0, ',', '.') }}
                            @else
                                <span style="color: #999;">Tidak tersedia</span>
                            @endif
                        </div>
                        <div class="stock">Stok: {{ $produk->stok_250gr }}</div>
                    </div>
                    
                    <div class="varian-card">
                        <div class="label">500 Gram</div>
                        <div class="price">
                            @if($produk->harga_500gr)
                                Rp {{ number_format($produk->harga_500gr, 0, ',', '.') }}
                            @else
                                <span style="color: #999;">Tidak tersedia</span>
                            @endif
                        </div>
                        <div class="stock">Stok: {{ $produk->stok_500gr }}</div>
                    </div>
                    
                    <div class="varian-card">
                        <div class="label">1 Kilogram</div>
                        <div class="price">
                            @if($produk->harga_1kg)
                                Rp {{ number_format($produk->harga_1kg, 0, ',', '.') }}
                            @else
                                <span style="color: #999;">Tidak tersedia</span>
                            @endif
                        </div>
                        <div class="stock">Stok: {{ $produk->stok_1kg }}</div>
                    </div>
                </div>
            </div>

            <div class="actions">
                <a href="{{ route('admin.produk.edit', $produk->id) }}" class="btn btn-warning">✏️ Edit Produk</a>
                <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">🗑️ Hapus Produk</button>
                </form>
                <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">← Kembali ke Daftar</a>
            </div>
        </div>
    </div>
</body>
</html>
