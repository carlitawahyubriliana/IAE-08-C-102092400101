<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Agro Jamur Pabuwaran</title>
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

        .container {
            max-width: 1000px;
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

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #0d4d4d;
        }

        .checkout-container {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 20px;
        }

        .form-section {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #0d4d4d;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e0e0e0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .order-summary {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            height: fit-content;
        }

        .summary-item {
            display: flex;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .summary-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .summary-item-info {
            flex: 1;
        }

        .summary-item-name {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .summary-item-variant {
            font-size: 13px;
            color: #666;
        }

        .summary-item-price {
            text-align: right;
            font-weight: 600;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            color: #666;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            font-size: 20px;
            font-weight: bold;
            color: #0d4d4d;
            border-top: 2px solid #0d4d4d;
            margin-top: 10px;
        }

        .btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
            margin-top: 20px;
        }

        .btn-primary {
            background: #0d4d4d;
            color: white;
        }

        .btn-primary:hover {
            background: #0a3535;
        }

        @media (max-width: 768px) {
            .checkout-container {
                grid-template-columns: 1fr;
            }
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">🍄 Agro Jamur Pabuwaran</div>
    </nav>

    <div class="container">
        <a href="{{ route('keranjang.index') }}" class="back-btn">← kembali ke keranjang</a>

        <div class="header">
            <h1>Checkout</h1>
            <p style="color: #666;">Lengkapi data untuk menyelesaikan pesanan</p>
        </div>

        <form action="{{ route('checkout.proses') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="checkout-container">
                <div>
                    <!-- Alamat Pengiriman -->
                    <div class="form-section" style="margin-bottom: 20px;">
                        <div class="section-title">📍 Alamat Pengiriman</div>
                        
                        <div class="form-group">
                            <label>Nama Penerima *</label>
                            <input type="text" name="nama_penerima" value="{{ auth()->user()->name }}" required>
                        </div>

                        <div class="form-group">
                            <label>No. Telepon *</label>
                            <input type="text" name="no_telp" placeholder="08xxxxxxxxxx" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Provinsi *</label>
                                <input type="text" name="provinsi" placeholder="Jawa Tengah" required>
                            </div>
                            <div class="form-group">
                                <label>Kota/Kabupaten *</label>
                                <input type="text" name="kota" placeholder="Banyumas" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Kode Pos *</label>
                            <input type="text" name="kode_pos" placeholder="53171" required>
                        </div>

                        <div class="form-group">
                            <label>Alamat Lengkap *</label>
                            <textarea name="alamat_lengkap" placeholder="Nama jalan, nomor rumah, RT/RW" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Patokan (Opsional)</label>
                            <input type="text" name="patokan" placeholder="Dekat warung, sebelah masjid, dll">
                        </div>
                    </div>

                    <!-- Pengiriman -->
                    <div class="form-section" style="margin-bottom: 20px;">
                        <div class="section-title">🚚 Pengiriman</div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label>Kurir *</label>
                                <select name="kurir" required>
                                    <option value="">Pilih Kurir</option>
                                    <option value="JNT Express">JNT Express</option>
                                    <option value="JNE">JNE</option>
                                    <option value="SiCepat">SiCepat</option>
                                    <option value="AnterAja">AnterAja</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Layanan *</label>
                                <select name="layanan_kurir" required>
                                    <option value="">Pilih Layanan</option>
                                    <option value="Reguler">Reguler (2-3 hari)</option>
                                    <option value="Express">Express (1 hari)</option>
                                    <option value="Same Day">Same Day</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Pembayaran -->
                    <div class="form-section">
                        <div class="section-title">💰 Pembayaran</div>
                        
                        <div class="form-group">
                            <label>Metode Pembayaran *</label>
                            <select name="metode_pembayaran" required>
                                <option value="">Pilih Metode</option>
                                <option value="Transfer Bank BRI">Transfer Bank BRI</option>
                                <option value="Transfer Bank BCA">Transfer Bank BCA</option>
                                <option value="Transfer Bank Mandiri">Transfer Bank Mandiri</option>
                                <option value="Transfer Bank BNI">Transfer Bank BNI</option>
                                <option value="E-Wallet (OVO/GoPay/Dana)">E-Wallet (OVO/GoPay/Dana)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Upload Bukti Pembayaran (Opsional)</label>
                            <input type="file" name="bukti_pembayaran" accept="image/*">
                            <small style="color: #666; display: block; margin-top: 5px;">Format: JPG, PNG. Max 2MB</small>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="order-summary">
                    <div class="section-title">📦 Produk</div>
                    
                    @foreach($keranjang as $item)
                    <div class="summary-item">
                        @if($item['gambar'])
                            <img src="{{ asset('storage/' . $item['gambar']) }}" alt="{{ $item['nama'] }}">
                        @else
                            <img src="{{ asset('images/placeholder.png') }}" alt="{{ $item['nama'] }}">
                        @endif
                        <div class="summary-item-info">
                            <div class="summary-item-name">{{ $item['nama'] }}</div>
                            <div class="summary-item-variant">{{ $item['varian'] }} x {{ $item['jumlah'] }}</div>
                        </div>
                        <div class="summary-item-price">
                            Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}
                        </div>
                    </div>
                    @endforeach

                    <div style="margin-top: 20px;">
                        <div class="summary-row">
                            <span>Subtotal produk</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Subtotal pengiriman</span>
                            <span>Rp {{ number_format($biayaPengiriman, 0, ',', '.') }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Biaya penanganan</span>
                            <span>Rp {{ number_format($biayaPenanganan, 0, ',', '.') }}</span>
                        </div>
                        <div class="summary-total">
                            <span>Total Pembayaran</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Buat Pesanan
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
