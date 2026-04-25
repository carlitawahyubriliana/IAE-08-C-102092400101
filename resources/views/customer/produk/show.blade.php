<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produk->nama }} - Agro Jamur Pabuwaran</title>
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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

        .back-btn:hover {
            text-decoration: underline;
        }

        .product-detail {
            background: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .product-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 30px;
        }

        .product-image {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }

        .product-image img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 10px;
        }

        .product-info h1 {
            color: #0d4d4d;
            margin-bottom: 15px;
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            color: #666;
        }

        .rating .stars {
            color: #ffc107;
            font-size: 18px;
        }

        .description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .variant-selector {
            margin-bottom: 25px;
        }

        .variant-selector label {
            display: block;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }

        .variant-buttons {
            display: flex;
            gap: 10px;
        }

        .variant-btn {
            flex: 1;
            padding: 12px 20px;
            border: 2px solid #e0e0e0;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
        }

        .variant-btn:hover {
            border-color: #0d4d4d;
        }

        .variant-btn.active {
            background: #0d4d4d;
            color: white;
            border-color: #0d4d4d;
        }

        .price {
            font-size: 28px;
            font-weight: bold;
            color: #0d4d4d;
            margin-bottom: 20px;
        }

        .quantity-selector {
            margin-bottom: 25px;
        }

        .quantity-selector label {
            display: block;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .qty-btn {
            width: 40px;
            height: 40px;
            border: 2px solid #0d4d4d;
            background: white;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .qty-btn:hover {
            background: #0d4d4d;
            color: white;
        }

        .qty-input {
            width: 80px;
            height: 40px;
            text-align: center;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
        }

        .actions {
            display: flex;
            gap: 15px;
        }

        .btn {
            flex: 1;
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
        }

        .btn-primary {
            background: #0d4d4d;
            color: white;
        }

        .btn-primary:hover {
            background: #0a3535;
        }

        .btn-secondary {
            background: white;
            color: #0d4d4d;
            border: 2px solid #0d4d4d;
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

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 768px) {
            .product-grid {
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
                <a href="{{ route('keranjang.index') }}" class="btn-keranjang">🛒 Keranjang</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit"
                        style="background: none; border: none; color: white; cursor: pointer;">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}">Masuk</a>
            @endauth
        </nav>
    </nav>

    <div class="container">
        <a href="/" class="back-btn">← kembali ke beranda</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <div class="product-detail">
            <div class="product-grid">
                <div>
                    <div class="product-image">
                        @if($produk->gambar)
                            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}">
                        @else
                            <img src="{{ asset('images/placeholder.png') }}" alt="{{ $produk->nama }}">
                        @endif
                    </div>

                    @if($produkLainnya->count() > 0)
                    <!-- Produk Jamur Lainnya -->
                    <div style="margin-top: 30px;">
                        <h3 style="color: #0d4d4d; margin-bottom: 15px; font-size: 18px; font-weight: 600;">Tambah Produk Jamur Lain</h3>
                        
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;">
                            @foreach($produkLainnya as $item)
                            <a href="{{ route('produk.show', $item->id) }}" style="background: #f8f9fa; border-radius: 8px; padding: 12px; text-decoration: none; color: inherit; display: block; transition: all 0.3s; border: 2px solid #e0e0e0;" onmouseover="this.style.borderColor='#0d4d4d'; this.style.transform='translateY(-3px)'" onmouseout="this.style.borderColor='#e0e0e0'; this.style.transform='translateY(0)'">
                                <div style="text-align: center; margin-bottom: 8px;">
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" 
                                            style="width: 100%; height: 100px; object-fit: cover; border-radius: 6px;">
                                    @else
                                        <div style="width: 100%; height: 100px; display: flex; align-items: center; justify-content: center; background: #e9ecef; border-radius: 6px; font-size: 36px;">
                                            🍄
                                        </div>
                                    @endif
                                </div>
                                <div style="text-align: center;">
                                    <h4 style="color: #0d4d4d; font-size: 13px; margin-bottom: 6px; font-weight: 600; line-height: 1.3;">{{ $item->nama }}</h4>
                                    <div style="display: flex; flex-direction: column; gap: 4px; margin-bottom: 6px; color: #666; font-size: 11px;">
                                        <span>⭐ {{ $item->rating }}</span>
                                        <span>{{ $item->jumlah_terjual }}+ terjual</span>
                                    </div>
                                    <div style="color: #0d4d4d; font-weight: bold; font-size: 13px;">
                                        Rp {{ number_format($item->harga_250gr, 0, ',', '.') }}
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <div class="product-info">
                    <h1>{{ $produk->nama }}</h1>

                    <div class="rating">
                        <span class="stars">⭐ {{ $produk->rating }}</span>
                        <span>{{ $produk->jumlah_terjual }}+ terjual minggu ini</span>
                    </div>

                    <p class="description">{{ $produk->deskripsi }}</p>

                    <form action="{{ route('keranjang.tambah') }}" method="POST">
                        @csrf
                        <input type="hidden" name="produk_id" value="{{ $produk->id }}">

                        <!-- Variant Selector -->
                        <div class="variant-selector">
                            <label>Pilih Varian:</label>
                            <div class="variant-buttons">
                                <button type="button" class="variant-btn active" data-varian="250gr"
                                    data-harga="{{ $produk->harga_250gr }}" data-stok="{{ $produk->stok_250gr }}">
                                    250 GR<br>
                                    <small>Rp {{ number_format($produk->harga_250gr, 0, ',', '.') }}</small>
                                </button>
                                <button type="button" class="variant-btn" data-varian="500gr"
                                    data-harga="{{ $produk->harga_500gr }}" data-stok="{{ $produk->stok_500gr }}">
                                    500 GR<br>
                                    <small>Rp {{ number_format($produk->harga_500gr, 0, ',', '.') }}</small>
                                </button>
                                <button type="button" class="variant-btn" data-varian="1kg"
                                    data-harga="{{ $produk->harga_1kg }}" data-stok="{{ $produk->stok_1kg }}">
                                    1 KG<br>
                                    <small>Rp {{ number_format($produk->harga_1kg, 0, ',', '.') }}</small>
                                </button>
                            </div>
                            <input type="hidden" name="varian" id="selected-varian" value="250gr">
                        </div>

                        <!-- Price -->
                        <div class="price" id="display-price">
                            Rp {{ number_format($produk->harga_250gr, 0, ',', '.') }}
                        </div>

                        <!-- Quantity -->
                        <div class="quantity-selector">
                            <label>Jumlah:</label>
                            <div class="quantity-controls">
                                <button type="button" class="qty-btn" id="qty-minus">−</button>
                                <input type="number" name="jumlah" id="qty-input" value="1" min="1" class="qty-input">
                                <button type="button" class="qty-btn" id="qty-plus">+</button>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="actions">
                            <button type="submit" name="action" value="cart" class="btn btn-primary">
                                🛒 tambah keranjang
                            </button>
                            <button type="submit" name="action" value="buy_now" class="btn btn-secondary">
                                beli sekarang ↗
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Variant selection
        const variantButtons = document.querySelectorAll('.variant-btn');
        const selectedVarianInput = document.getElementById('selected-varian');
        const displayPrice = document.getElementById('display-price');
        const qtyInput = document.getElementById('qty-input');

        variantButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove active from all
                variantButtons.forEach(b => b.classList.remove('active'));
                // Add active to clicked
                btn.classList.add('active');

                // Update hidden input
                const varian = btn.dataset.varian;
                const harga = parseInt(btn.dataset.harga);
                const stok = parseInt(btn.dataset.stok);

                selectedVarianInput.value = varian;
                displayPrice.textContent = 'Rp ' + harga.toLocaleString('id-ID');
                qtyInput.max = stok;

                // Reset quantity to 1
                qtyInput.value = 1;
            });
        });

        // Quantity controls
        document.getElementById('qty-minus').addEventListener('click', () => {
            if (qtyInput.value > 1) {
                qtyInput.value = parseInt(qtyInput.value) - 1;
            }
        });

        document.getElementById('qty-plus').addEventListener('click', () => {
            const max = parseInt(qtyInput.max) || 999;
            if (qtyInput.value < max) {
                qtyInput.value = parseInt(qtyInput.value) + 1;
            }
        });
    </script>
</body>

</html>