<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - Agro Jamur Pabuwaran</title>
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

        .navbar .logo {
            font-size: 20px;
            font-weight: bold;
        }

        .navbar nav {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            transition: opacity 0.3s;
        }

        .navbar a:hover {
            opacity: 0.8;
        }

        .btn-keranjang {
            background: white;
            color: #0d4d4d;
            padding: 8px 16px;
            border-radius: 5px;
            font-weight: 600;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            color: #0d4d4d;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
        }

        .filters {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .filters input,
        .filters select {
            flex: 1;
            min-width: 200px;
            padding: 10px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            font-size: 14px;
        }

        .btn-primary {
            background: #0d4d4d;
            color: white;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .product-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .product-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-body {
            padding: 20px;
        }

        .product-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            font-size: 13px;
            color: #666;
        }

        .product-rating {
            color: #ffc107;
        }

        .product-price {
            font-size: 16px;
            font-weight: bold;
            color: #0d4d4d;
            margin-bottom: 15px;
        }

        .product-actions {
            display: flex;
            gap: 10px;
        }

        .btn-detail {
            flex: 1;
            background: #0d4d4d;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-detail:hover {
            background: #0a3535;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
        }

        .pagination a,
        .pagination span {
            padding: 8px 12px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
        }

        .pagination .active {
            background: #0d4d4d;
            color: white;
            border-color: #0d4d4d;
        }

        .no-data {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">🍄 Agro Jamur Pabuwaran</div>
        <nav>
            <a href="/">Beranda</a>
            <a href="{{ route('produk.index') }}">Produk</a>
            @auth
                <a href="{{ route('customer.pesanan.index') }}">Pesanan Saya</a>
                <a href="{{ route('keranjang.index') }}" class="btn-keranjang">🛒 Keranjang</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: white; cursor: pointer;">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}">Masuk</a>
            @endauth
        </nav>
    </nav>

    <div class="container">
        <div class="header">
            <h1>🍄 Produk Jamur Segar</h1>
            <p>Jamur berkualitas tinggi langsung dari kebun kami</p>
        </div>

        <!-- Filters -->
        <form method="GET" class="filters">
            <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}">
            <select name="kategori">
                <option value="">Semua Kategori</option>
                <option value="tiram" {{ request('kategori') == 'tiram' ? 'selected' : '' }}>Jamur Tiram</option>
                <option value="kuping" {{ request('kategori') == 'kuping' ? 'selected' : '' }}>Jamur Kuping</option>
                <option value="kancing" {{ request('kategori') == 'kancing' ? 'selected' : '' }}>Jamur Kancing</option>
                <option value="shiitake" {{ request('kategori') == 'shiitake' ? 'selected' : '' }}>Jamur Shiitake</option>
            </select>
            <button type="submit" class="btn btn-primary">🔍 Cari</button>
            @if(request('search') || request('kategori'))
                <a href="{{ route('produk.index') }}" class="btn btn-primary">✖ Reset</a>
            @endif
        </form>

        <!-- Products Grid -->
        @if($produk->count() > 0)
            <div class="products-grid">
                @foreach($produk as $item)
                <div class="product-card">
                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="product-img">
                    @else
                        <img src="{{ asset('images/placeholder.png') }}" alt="{{ $item->nama }}" class="product-img">
                    @endif
                    <div class="product-body">
                        <h3 class="product-title">{{ $item->nama }}</h3>
                        <div class="product-meta">
                            <span class="product-rating">⭐ {{ $item->rating }}</span>
                            <span>{{ $item->jumlah_terjual }}+ terjual</span>
                        </div>
                        <div class="product-price">
                            Mulai Rp {{ number_format($item->harga_250gr, 0, ',', '.') }}
                        </div>
                        <div class="product-actions">
                            <a href="{{ route('produk.show', $item->id) }}" class="btn-detail">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination">
                {{ $produk->links('pagination::simple-default') }}
            </div>
        @else
            <div class="no-data">
                <p>Tidak ada produk ditemukan</p>
            </div>
        @endif
    </div>
</body>
</html>
