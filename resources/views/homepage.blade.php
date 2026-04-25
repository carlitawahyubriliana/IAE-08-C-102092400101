<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Agro Jamur Pabuwaran</title>
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
</head>

<body>
    <header class="site-header">
        <div class="container header-inner">
            <img src="{{ asset('images/logo agro.png') }}" alt="Logo Agro" class="brand">
            <nav class="main-nav">
                <a href="/">Beranda</a>
                <a href="{{ route('tentang-kami') }}">Tentang Kami</a>
                <a href="{{ route('kontak') }}">Kontak</a>
                <a href="{{ route('produk.index') }}">Produk</a>
                <a button class="btn-chart" href="{{ route('keranjang.index') }}">Keranjang</a>
                
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a button class="btn-login" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    @else
                        <a button class="btn-login" href="{{ route('customer.pesanan.index') }}">Pesanan Saya</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-login" style="border: none; cursor: pointer;">Keluar</button>
                    </form>
                @else
                    <a button class="btn-login" href="{{ route('login') }}">Masuk</a>
                @endauth
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="hero-overlay">
            <div class="container hero-content">
                <h1>AGRO JAMUR PABUWARAN</h1>
                <p class="lead">Agro Jamur adalah penyedia jamur segar berkualitas tinggi yang dipanen langsung dari
                    budidaya modern dan higienis.</p>
                <a href="{{ route('produk.index') }}" class="btn-cta">Lihat Jamur</a>
            </div>
        </div>
        <img src="{{ asset('images/background fix.jpg') }}" alt="Kebun Jamur" class="backgpround fix">
    </section>

    <main class="container">
        <section id="why" class="why">
            <img src="{{ asset('images/logo agro.png') }}" class="why-logo" alt="Logo">
            <h2>Mengapa Memilih Agro Jamur Pabuwaran?</h2>
            <p class="why-lead">Jamur kami dibudidayakan dengan teknologi modern dan standar kebersihan tinggi.</p>

            <div class="why-grid">
                <div class="card-small">
                    <h3>100% Organik & Alami</h3>
                    <p>Dibudidayakan tanpa pestisida dan bahan kimia berbahaya.</p>
                </div>
                <div class="card-small">
                    <h3>Kualitas Terjamin & Bersertifikat</h3>
                    <p>Memiliki sertifikat BPOM dan Halal MUI untuk setiap batch.</p>
                </div>
                <div class="card-small">
                    <h3>Segar Langsung dari Kebun</h3>
                    <p>Dipanen setiap hari dan langsung dikirim agar tetap segar.</p>
                </div>
                <div class="card-small">
                    <h3>Tinggi Protein & Nutrisi</h3>
                    <p>Kaya akan protein nabati, serat, dan vitamin.</p>
                </div>
            </div>
        </section>

        <section id="produk" class="products">
            <h2>Produk Unggulan Kami</h2>
            <p class="sub">4 Jamur Pilihan Terbaik Langsung dari Kebun Pabuwaran</p>

            <div class="products-grid">
                <article class="product">
                    <img src="{{ asset('images/tiram putih.png') }}" alt="Jamur Tiram Putih">
                    <h4>Jamur Tiram Putih</h4>
                    <p>450+ terjual minggu ini</p>
                    <a class="product-btn" href="{{ route('produk.show', 1) }}">BUY NOW</a>
                </article>

                <article class="product">
                    <img src="{{ asset('images/tiram coklat.png') }}" alt="Jamur Tiram Coklat">
                    <h4>Jamur Tiram Coklat</h4>
                    <p>200+ terjual minggu ini</p>
                    <a class="product-btn" href="{{ route('produk.show', 2) }}">BUY NOW</a>
                </article>

                <article class="product">
                    <img src="{{ asset('images/jamur kuping.png') }}" alt="Jamur Kuping">
                    <h4>Jamur Kuping</h4>
                    <p>285+ terjual minggu ini</p>
                    <a class="product-btn" href="{{ route('produk.show', 3) }}">BUY NOW</a>
                </article>

                <article class="product">
                    <img src="{{ asset('images/jamur kancing.png') }}" alt="Jamur Kancing">
                    <h4>Jamur Kancing</h4>
                    <p>150+ terjual minggu ini</p>
                    <a class="product-btn" href="{{ route('produk.show', 4) }}">BUY NOW</a>
                </article>
            </div>
        </section>

        <section class="testimonials">
            <h2>Hasil Nyata, Orang Nyata. Baca Cerita Mereka.</h2>
            <div class="test-grid">
                <div class="test-card">Jamur Kancing Fresh - pelanggan puas</div>
                <div class="test-card">Jamur Kuping Premium - testimoni</div>
                <div class="test-card">Jamur Tiram Putih Fresh - cerita</div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container footer-inner">
            <div class="brand-foot">
                <img src="{{ asset('images/logo agro.png') }}" alt="Logo" class="brand-small">
                <p>Agro Jamur Pabuwaran</p>
            </div>
            <div class="footer-links">
                <p>Kontak kami</p>
                <p>0821-xxxx-xxxx</p>
            </div>
        </div>
    </footer>
</body>

</html>