<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Agro Jamur Pabuwaran</title>
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
            margin-bottom: 10px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .cart-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .cart-items {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .cart-item {
            display: flex;
            gap: 20px;
            padding: 20px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
        }

        .item-info {
            flex: 1;
        }

        .item-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .item-variant {
            color: #666;
            margin-bottom: 10px;
        }

        .item-price {
            font-size: 16px;
            font-weight: bold;
            color: #0d4d4d;
        }

        .item-actions {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-end;
        }

        .qty-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .qty-btn {
            width: 30px;
            height: 30px;
            border: 2px solid #0d4d4d;
            background: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .qty-input {
            width: 50px;
            text-align: center;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            padding: 5px;
        }

        .btn-remove {
            color: #e74c3c;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .cart-summary {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            height: fit-content;
        }

        .summary-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e0e0e0;
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
            border-top: 2px solid #e0e0e0;
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
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .btn-primary {
            background: #0d4d4d;
            color: white;
        }

        .btn-primary:hover {
            background: #0a3535;
        }

        .empty-cart {
            background: white;
            border-radius: 10px;
            padding: 60px 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .empty-cart h2 {
            color: #999;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .cart-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">🍄 Agro Jamur Pabuwaran</div>
        <nav>
            <a href="/">Beranda</a>
            @auth
                <a href="{{ route('customer.pesanan.index') }}">Pesanan Saya</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: white; cursor: pointer;">Keluar</button>
                </form>
            @endauth
        </nav>
    </nav>

    <div class="container">
        <a href="/" class="back-btn">← kembali ke beranda</a>

        <div class="header">
            <h1>🛒 Keranjang Belanja</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(count($keranjang) > 0)
            <div class="cart-container">
                <div class="cart-items">
                    @foreach($keranjang as $key => $item)
                    <div class="cart-item">
                        <div class="item-image">
                            @if($item['gambar'])
                                <img src="{{ asset('storage/' . $item['gambar']) }}" alt="{{ $item['nama'] }}">
                            @else
                                <img src="{{ asset('images/placeholder.png') }}" alt="{{ $item['nama'] }}">
                            @endif
                        </div>
                        <div class="item-info">
                            <div class="item-name">{{ $item['nama'] }}</div>
                            <div class="item-variant">Varian: {{ $item['varian'] }}</div>
                            <div class="item-price">Rp {{ number_format($item['harga'], 0, ',', '.') }}</div>
                        </div>
                        <div class="item-actions">
                            <form action="{{ route('keranjang.update', $key) }}" method="POST" class="qty-controls">
                                @csrf
                                @method('PUT')
                                <button type="button" class="qty-btn" onclick="decreaseQty(this)">−</button>
                                <input type="number" name="jumlah" value="{{ $item['jumlah'] }}" min="1" class="qty-input" onchange="this.form.submit()">
                                <button type="button" class="qty-btn" onclick="increaseQty(this)">+</button>
                            </form>
                            <form action="{{ route('keranjang.hapus', $key) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-remove" onclick="return confirm('Hapus produk dari keranjang?')">🗑️ Hapus</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="cart-summary">
                    <div class="summary-title">Ringkasan Belanja</div>
                    <div class="summary-row">
                        <span>Total Produk</span>
                        <span>{{ count($keranjang) }} item</span>
                    </div>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-total">
                        <span>Total</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="btn btn-primary">
                        Lanjut ke Checkout
                    </a>
                </div>
            </div>
        @else
            <div class="empty-cart">
                <h2>🛒 Keranjang Belanja Kosong</h2>
                <p style="color: #999; margin-bottom: 20px;">Yuk mulai belanja jamur segar berkualitas!</p>
                <a href="/" class="btn btn-primary" style="max-width: 300px; margin: 0 auto;">
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>

    <script>
        function decreaseQty(btn) {
            const input = btn.nextElementSibling;
            if (input.value > 1) {
                input.value = parseInt(input.value) - 1;
                input.form.submit();
            }
        }

        function increaseQty(btn) {
            const input = btn.previousElementSibling;
            input.value = parseInt(input.value) + 1;
            input.form.submit();
        }
    </script>
</body>
</html>
