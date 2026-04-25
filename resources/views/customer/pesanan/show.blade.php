<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #{{ $pesanan->id }} - Agro Jamur Pabuwaran</title>
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
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .back-btn {
            display: inline-block;
            color: #0d4d4d;
            text-decoration: none;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .back-btn:hover {
            text-decoration: underline;
        }

        .header {
            background: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            color: #0d4d4d;
            margin-bottom: 5px;
        }

        .order-date {
            color: #666;
            font-size: 14px;
        }

        .badge {
            padding: 8px 16px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            display: inline-block;
            margin-left: 10px;
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

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .card h3 {
            color: #0d4d4d;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e0e0e0;
        }

        .order-item {
            display: flex;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .item-info {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }

        .item-variant {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .item-price {
            font-size: 14px;
            color: #666;
        }

        .item-total {
            font-weight: 600;
            color: #0d4d4d;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #666;
            font-weight: 600;
        }

        .info-value {
            color: #333;
            text-align: right;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-top: 2px solid #e0e0e0;
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
            color: #0d4d4d;
        }

        .tracking-info {
            background: #e7f3ff;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .tracking-info strong {
            color: #0d4d4d;
        }

        @media (max-width: 768px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .header-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
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
        <a href="{{ route('customer.pesanan.index') }}" class="back-btn">← Kembali ke Daftar Pesanan</a>

        <div class="header">
            <div class="header-content">
                <div>
                    <h1>Pesanan #{{ $pesanan->id }}</h1>
                    <div class="order-date">{{ $pesanan->tanggal_pesanan->format('d F Y, H:i') }} WIB</div>
                </div>
                <div>
                    <span class="badge badge-{{ $pesanan->status }}">{{ ucfirst($pesanan->status) }}</span>
                    <span class="badge badge-{{ $pesanan->status_pembayaran }}">{{ str_replace('_', ' ', ucfirst($pesanan->status_pembayaran)) }}</span>
                </div>
            </div>
        </div>

        <div class="content-grid">
            <div>
                <!-- Product Items -->
                <div class="card">
                    <h3>📦 Produk yang Dipesan</h3>
                    @foreach($pesanan->items as $item)
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
                            <div class="item-variant">Varian: {{ $item->varian }}</div>
                            <div class="item-price">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }} x {{ $item->jumlah }}</div>
                        </div>
                        <div class="item-total">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Shipping Address -->
                <div class="card" style="margin-top: 20px;">
                    <h3>📍 Alamat Pengiriman</h3>
                    <div class="info-row">
                        <span class="info-label">Nama Penerima:</span>
                        <span class="info-value">{{ $pesanan->nama_penerima }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">No. Telepon:</span>
                        <span class="info-value">{{ $pesanan->no_telp }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Provinsi:</span>
                        <span class="info-value">{{ $pesanan->provinsi }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Kota:</span>
                        <span class="info-value">{{ $pesanan->kota }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Kode Pos:</span>
                        <span class="info-value">{{ $pesanan->kode_pos }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Alamat Lengkap:</span>
                        <span class="info-value" style="max-width: 70%;">{{ $pesanan->alamat_lengkap }}</span>
                    </div>
                    @if($pesanan->patokan)
                    <div class="info-row">
                        <span class="info-label">Patokan:</span>
                        <span class="info-value" style="max-width: 70%;">{{ $pesanan->patokan }}</span>
                    </div>
                    @endif
                </div>

                <!-- Shipping Info -->
                <div class="card" style="margin-top: 20px;">
                    <h3>🚚 Informasi Pengiriman</h3>
                    <div class="info-row">
                        <span class="info-label">Kurir:</span>
                        <span class="info-value">{{ strtoupper($pesanan->kurir) }} - {{ $pesanan->layanan_kurir }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Metode Pembayaran:</span>
                        <span class="info-value">{{ ucfirst($pesanan->metode_pembayaran) }}</span>
                    </div>
                    @if($pesanan->no_resi)
                    <div class="tracking-info">
                        <strong>Nomor Resi:</strong> {{ $pesanan->no_resi }}
                        <div style="margin-top: 10px; color: #666; font-size: 14px;">
                            Pesanan Anda sedang dalam pengiriman. Gunakan nomor resi untuk melacak paket.
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Payment Summary -->
            <div>
                <div class="card">
                    <h3>💰 Ringkasan Pembayaran</h3>
                    <div class="info-row">
                        <span class="info-label">Subtotal Produk:</span>
                        <span class="info-value">Rp {{ number_format($pesanan->subtotal_produk, 0, ',', '.') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Biaya Pengiriman:</span>
                        <span class="info-value">Rp {{ number_format($pesanan->biaya_pengiriman, 0, ',', '.') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Biaya Penanganan:</span>
                        <span class="info-value">Rp {{ number_format($pesanan->biaya_penanganan, 0, ',', '.') }}</span>
                    </div>
                    <div class="total-row">
                        <span>Total Pembayaran:</span>
                        <span>Rp {{ number_format($pesanan->total_pembayaran, 0, ',', '.') }}</span>
                    </div>

                    @if($pesanan->bukti_pembayaran)
                    <div style="margin-top: 20px; padding-top: 20px; border-top: 2px solid #e0e0e0;">
                        <strong style="color: #0d4d4d; display: block; margin-bottom: 10px;">Bukti Pembayaran:</strong>
                        <img src="{{ asset('storage/' . $pesanan->bukti_pembayaran) }}" alt="Bukti Pembayaran" style="width: 100%; border-radius: 8px; border: 1px solid #e0e0e0;">
                    </div>
                    @endif
                </div>

                @if($pesanan->status == 'selesai')
                <div class="card" style="margin-top: 20px; background: #d4edda; border: 2px solid #c3e6cb;">
                    <div style="text-align: center; color: #155724;">
                        <h3 style="border: none; padding: 0; margin-bottom: 10px;">✓ Pesanan Selesai</h3>
                        <p style="margin: 0;">Terima kasih telah berbelanja di Agro Jamur Pabuwaran!</p>
                    </div>
                </div>
                @elseif($pesanan->status == 'dibatalkan')
                <div class="card" style="margin-top: 20px; background: #f8d7da; border: 2px solid #f5c6cb;">
                    <div style="text-align: center; color: #721c24;">
                        <h3 style="border: none; padding: 0; margin-bottom: 10px;">✕ Pesanan Dibatalkan</h3>
                        <p style="margin: 0;">Pesanan ini telah dibatalkan.</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
