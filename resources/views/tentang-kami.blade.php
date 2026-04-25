<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Tentang Kami - Agro Jamur Pabuwaran</title>
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <style>
        .page-container {
            min-height: 80vh;
            padding: 40px 20px;
        }
        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .page-header h1 {
            font-size: 36px;
            color: #0d4d4d;
            margin-bottom: 20px;
        }
        .page-content {
            max-width: 900px;
            margin: 0 auto;
            line-height: 1.8;
            color: #333;
        }
        .page-content p {
            margin-bottom: 20px;
            text-align: justify;
        }
        .section {
            margin-bottom: 40px;
        }
        .section h2 {
            color: #0d4d4d;
            font-size: 24px;
            margin-bottom: 15px;
            border-bottom: 2px solid #0d4d4d;
            padding-bottom: 10px;
        }
    </style>
</head>

<body>
    <header class="site-header">
        <div class="container header-inner">
            <img src="{{ asset('images/logo agro.png') }}" alt="Logo Agro" class="brand">
            <nav class="main-nav">
                <a href="{{ route('home') }}">Beranda</a>
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

    <main class="page-container">
        <div class="page-content">
            <div class="page-header">
                <h1>Tentang Kami</h1>
                <p style="font-style: italic; color: #666;">Mengenal lebih jauh tentang AGRO JAMUR PABUWARAN</p>
            </div>

            <div class="section">
                <h2>Siapa Kami?</h2>
                <p>
                    AGRO JAMUR PABUWARAN adalah sebuah perusahaan pertanian modern yang berfokus pada budidaya jamur berkualitas tinggi. 
                    Kami berkomitmen untuk menyediakan jamur segar terbaik dengan standar kebersihan dan kualitas internasional.
                </p>
            </div>

            <div class="section">
                <h2>Misi Kami</h2>
                <p>
                    Misi kami adalah menyediakan produk jamur berkualitas premium yang sehat, aman, dan terjangkau bagi seluruh masyarakat Indonesia. 
                    Kami percaya bahwa jamur yang ditanam dengan metode modern dan yang terjaga kebersihannya dapat meningkatkan kesehatan dan kesejahteraan konsumen.
                </p>
            </div>

            <div class="section">
                <h2>Visi Kami</h2>
                <p>
                    Menjadi produsen jamur terkemuka di Indonesia yang dikenal karena komitmen terhadap kualitas, keberlanjutan, dan inovasi dalam budidaya jamur modern.
                </p>
            </div>

            <div class="section">
                <h2>Keunggulan Kami</h2>
                <ul style="margin-left: 20px;">
                    <li>Teknologi budidaya modern dan higienis</li>
                    <li>Jamur segar dipanen langsung dari kebun</li>
                    <li>Standar kualitas internasional</li>
                    <li>Layanan pelanggan yang responsif</li>
                    <li>Harga yang kompetitif</li>
                    <li>Produk bersertifikat dan aman</li>
                </ul>
            </div>

            <div class="section">
                <h2>Tim Kami</h2>
                <p>
                    Tim AGRO JAMUR PABUWARAN terdiri dari para profesional berpengalaman di bidang pertanian, manajemen, dan pemasaran. 
                    Setiap anggota tim kami berdedikasi untuk memberikan layanan terbaik kepada pelanggan.
                </p>
            </div>
        </div>
    </main>

    <footer class="site-footer">
        <div class="container">
            <p>&copy; 2025 AGRO JAMUR PABUWARAN. Semua hak dilindungi.</p>
        </div>
    </footer>
</body>

</html>
