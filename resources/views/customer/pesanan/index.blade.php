<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - Agro Jamur Pabuwaran</title>
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

        .btn-keranjang {
            background: white;
            color: #0d4d4d;
            padding: 8px 16px;
            border-radius: 5px;
            font-weight: 600;
        }

        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #0d4d4d;
            margin-bottom: 10px;
        }

        .order-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 15px;
            border-bottom: 2px solid #e0e0e0;
            margin-bottom: 15px;
        }

        .order-id {
            font-weight: bold;
            color: #333;
        }

        .order-date {
            color: #666;
            font-size: 14px;
        }

        .badge {
            padding: 5px 12px;
            border-radius: 5px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-pending {
            background: #fff3cd;
            color: #856404;
        }

        .badge-dikonfirmasi {
            background: #cfe2ff;
            color: #084298;
        }

        .badge-diproses {
            background: #e7f3ff;
            color: #055160;
        }

        .badge-dikirim {
            background: #d1ecf1;
            color: #0c5460;
        }

        .badge-selesai {
            background: #d4edda;
            color: #155724;
        }

        .badge-dibatalkan {
            background: #f8d7da;
            color: #721c24;
        }

        .badge-belum_bayar {
            background: #fff3cd;
            color: #856404;
        }

        .badge-sudah_bayar {
            background: #d4edda;
            color: #155724;
        }

        .order-items {
            margin-bottom: 15px;
        }

        .order-item {
            display: flex;
            gap: 15px;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .item-info {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .item-variant {
            font-size: 13px;
            color: #666;
        }

        .order-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 2px solid #e0e0e0;
        }

        .order-total {
            font-size: 18px;
            font-weight: bold;
            color: #0d4d4d;
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

        .btn-primary:hover {
            background: #0a3535;
        }

        .no-data {
            background: white;
            border-radius: 10px;
            padding: 60px 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
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
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">🍄 Agro Jamur Pabuwaran</div>
        <nav>
            <a href="/">Beranda</a>
            <a href="{{ route('customer.pesanan.index') }}">Pesanan Saya</a>
            <a href="{{ route('keranjang.index') }}" class="btn-keranjang">🛒 Keranjang</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: white; cursor: pointer;">Keluar</button>
            </form>
        </nav>
    </nav>

    <div class="container">
        <div class="header">
            <h1>📦 Pesanan Saya</h1>
            <p style="color: #666;">Riwayat pesanan dan status pengiriman</p>
        </div>

        @if($pesanan->count() > 0)
            @foreach($pesanan as $order)
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <div class="order-id">Pesanan #{{ $order->id }}</div>
                        <div class="order-date">{{ $order->tanggal_pesanan->format('d M Y, H:i') }}</div>
                    </div>
                    <div style="text-align: right;">
                        <span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                        <span class="badge badge-{{ $order->status_pembayaran }}">{{ str_replace('_', ' ', ucfirst($order->status_pembayaran)) }}</span>
                    </div>
                </div>

                <div class="order-items">
                    @foreach($order->items as $item)
                    <div class="order-item">
                        <div class="item-image">
                            @if($item->produk && $item->produk->gambar)
                                <img src="{{ asset('storage/' . $item->produk->gambar) }}" alt="{{ $item->nama_produk }}">
                            @else
                                <img src="{{ asset('images/placeholder.png') }}" alt="{{ $item->nama_produk }}">
                            @endif
                        </div>
                        <div class="item-info">
                            <div class="item-name">{{ $item->nama_produk }}</div>
                            <div class="item-variant">{{ $item->varian }} x {{ $item->jumlah }}</div>
                        </div>
                        <div style="font-weight: 600;">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="order-footer">
                    <div class="order-total">
                        Total: Rp {{ number_format($order->total_pembayaran, 0, ',', '.') }}
                    </div>
                    <a href="{{ route('customer.pesanan.show', $order->id) }}" class="btn btn-primary">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach

            <!-- Pagination -->
            <div class="pagination">
                {{ $pesanan->links('pagination::simple-default') }}
            </div>
        @else
            <div class="no-data">
                <h2 style="color: #999; margin-bottom: 20px;">📦 Belum Ada Pesanan</h2>
                <p style="color: #999; margin-bottom: 20px;">Yuk mulai belanja jamur segar berkualitas!</p>
                <a href="/produk/1" class="btn btn-primary">
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>
</body>
</html>
