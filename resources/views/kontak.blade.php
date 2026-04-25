<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Kontak - Agro Jamur Pabuwaran</title>
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
        }
        .contact-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }
        @media (max-width: 768px) {
            .contact-section {
                grid-template-columns: 1fr;
            }
        }
        .contact-info, .contact-form {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .contact-info h2, .contact-form h2 {
            color: #0d4d4d;
            font-size: 24px;
            margin-bottom: 20px;
            border-bottom: 2px solid #0d4d4d;
            padding-bottom: 10px;
        }
        .contact-item {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        .contact-item:last-child {
            border-bottom: none;
        }
        .contact-label {
            font-weight: bold;
            color: #0d4d4d;
            font-size: 14px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .contact-value {
            color: #333;
            font-size: 16px;
            line-height: 1.6;
        }
        .contact-value a {
            color: #0d4d4d;
            text-decoration: none;
            transition: opacity 0.3s;
        }
        .contact-value a:hover {
            opacity: 0.7;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            color: #0d4d4d;
            margin-bottom: 8px;
            font-size: 14px;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #0d4d4d;
            box-shadow: 0 0 5px rgba(13, 77, 77, 0.3);
        }
        .btn-submit {
            background: #0d4d4d;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: opacity 0.3s;
            width: 100%;
        }
        .btn-submit:hover {
            opacity: 0.8;
        }
        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: #0d4d4d;
            color: white;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            text-decoration: none;
            transition: opacity 0.3s;
        }
        .social-links a:hover {
            opacity: 0.7;
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
                <h1>Hubungi Kami</h1>
                <p style="font-style: italic; color: #666;">Kami siap membantu menjawab pertanyaan Anda</p>
            </div>

            <div class="contact-section">
                <!-- Contact Info -->
                <div class="contact-info">
                    <h2>Informasi Kontak</h2>
                    
                    <div class="contact-item">
                        <div class="contact-label">📍 Alamat</div>
                        <div class="contact-value">
                            Jl. Pabuwaran No. 123<br>
                            Kabupaten Sukabumi<br>
                            Jawa Barat, Indonesia 43152
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-label">📞 Telepon</div>
                        <div class="contact-value">
                            <a href="tel:+6281234567890">(+62) 812-3456-7890</a>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-label">📧 Email</div>
                        <div class="contact-value">
                            <a href="mailto:info@agrojamur.com">info@agrojamur.com</a><br>
                            <a href="mailto:sales@agrojamur.com">sales@agrojamur.com</a>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-label">🕐 Jam Operasional</div>
                        <div class="contact-value">
                            Senin - Jumat: 08:00 - 17:00<br>
                            Sabtu: 08:00 - 13:00<br>
                            Minggu & Hari Libur: Tutup
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-label">🌐 Ikuti Kami</div>
                        <div class="social-links">
                            <a href="#" title="Facebook">f</a>
                            <a href="#" title="Instagram">📷</a>
                            <a href="#" title="Twitter">𝕏</a>
                            <a href="#" title="WhatsApp">W</a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-form">
                    <h2>Kirim Pesan</h2>
                    <form action="#" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama Anda *</label>
                            <input type="text" id="nama" name="nama" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Anda *</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="telepon">Nomor Telepon</label>
                            <input type="tel" id="telepon" name="telepon">
                        </div>

                        <div class="form-group">
                            <label for="subjek">Subjek *</label>
                            <input type="text" id="subjek" name="subjek" required>
                        </div>

                        <div class="form-group">
                            <label for="pesan">Pesan Anda *</label>
                            <textarea id="pesan" name="pesan" required></textarea>
                        </div>

                        <button type="submit" class="btn-submit">Kirim Pesan</button>
                    </form>
                </div>
            </div>

            <!-- Map Info -->
            <div style="background: #f9f9f9; padding: 30px; border-radius: 8px; text-align: center; margin-top: 40px;">
                <h2 style="color: #0d4d4d; margin-bottom: 20px;">Lokasi Kami</h2>
                <p style="color: #666; margin-bottom: 20px;">Kunjungi farm kami secara langsung untuk melihat proses budidaya jamur modern kami.</p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5066688894453!2d106.92424631533206!3d-6.9271793931788005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6990e0000001!2sKabupaten%20Sukabumi!5e0!3m2!1sid!2sid!4v1234567890123" width="100%" height="400" style="border:0; border-radius: 8px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
