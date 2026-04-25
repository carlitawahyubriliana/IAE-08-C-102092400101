<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Agro Jamur Pabuwaran</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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

        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .navbar .logout-btn {
            background: white;
            color: #0d4d4d;
            padding: 8px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .navbar .logout-btn:hover {
            background: #f0f0f0;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .welcome {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }

        .welcome h2 {
            color: #0d4d4d;
            margin-bottom: 10px;
        }

        .welcome p {
            color: #666;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-left: 4px solid #0d4d4d;
        }

        .stat-card h3 {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .stat-card .number {
            font-size: 32px;
            font-weight: bold;
            color: #0d4d4d;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .menu-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            text-align: center;
            text-decoration: none;
            color: #333;
            transition: all 0.3s;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .menu-card .icon {
            font-size: 48px;
            margin-bottom: 15px;
            color: #0d4d4d;
        }

        .menu-card h3 {
            color: #0d4d4d;
            margin-bottom: 10px;
        }

        .menu-card p {
            color: #666;
            font-size: 14px;
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
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>🍄 Agro Jamur Pabuwaran - Admin Panel</h1>
        <div class="user-info">
            <span>{{ Auth::user()->nama }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn" style="border: none; cursor: pointer;">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="welcome">
            <h2>Selamat Datang, {{ Auth::user()->nama }}! 👋</h2>
            <p>Kelola toko jamur Anda dari dashboard ini</p>
        </div>

        <div class="stats">
            <div class="stat-card">
                <h3>Total Produk</h3>
                <div class="number">{{ \App\Models\Produk::count() }}</div>
            </div>
            <div class="stat-card">
                <h3>Total Pesanan</h3>
                <div class="number">{{ \App\Models\Pesanan::count() }}</div>
            </div>
            <div class="stat-card">
                <h3>Pesanan Pending</h3>
                <div class="number">{{ \App\Models\Pesanan::where('status', 'pending')->count() }}</div>
            </div>
            <div class="stat-card">
                <h3>Total Customer</h3>
                <div class="number">{{ \App\Models\User::where('role', 'customer')->count() }}</div>
            </div>
        </div>

        <div class="menu-grid">
            <a href="{{ route('admin.produk.index') }}" class="menu-card">
                <div class="icon">📦</div>
                <h3>Kelola Produk</h3>
                <p>Tambah, edit, hapus produk</p>
            </a>
            <a href="{{ route('admin.pesanan.index') }}" class="menu-card">
                <div class="icon">🛒</div>
                <h3>Kelola Pesanan</h3>
                <p>Lihat dan proses pesanan</p>
            </a>
            <a href="{{ route('admin.customer.index') }}" class="menu-card">
                <div class="icon">👥</div>
                <h3>Kelola Customer</h3>
                <p>Lihat data customer</p>
            </a>
            <a href="{{ route('admin.laporan.index') }}" class="menu-card">
                <div class="icon">📊</div>
                <h3>Laporan</h3>
                <p>Lihat statistik penjualan</p>
            </a>
        </div>
    </div>
</body>
</html>
