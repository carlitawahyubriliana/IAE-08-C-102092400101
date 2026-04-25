<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - Admin</title>
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

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            transition: opacity 0.3s;
        }

        .navbar a:hover {
            opacity: 0.8;
        }

        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h2 {
            color: #0d4d4d;
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

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .filters {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .filters select,
        .filters input {
            padding: 10px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
        }

        .filters button {
            padding: 10px 20px;
            background: #0d4d4d;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background: #0d4d4d;
            color: white;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
            font-size: 14px;
        }

        table tbody tr:hover {
            background: #f9f9f9;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
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

        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: all 0.3s;
            font-size: 13px;
        }

        .btn-info {
            background: #3498db;
            color: white;
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
        }

        .actions {
            display: flex;
            gap: 5px;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 5px;
        }

        .pagination a,
        .pagination span {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-decoration: none;
            color: #333;
            border-radius: 5px;
        }

        .pagination .active {
            background: #0d4d4d;
            color: white;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-box {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            text-align: center;
        }

        .stat-box .number {
            font-size: 24px;
            font-weight: bold;
            color: #0d4d4d;
        }

        .stat-box .label {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>🛒 Kelola Pesanan</h1>
        <div>
            <a href="{{ route('admin.dashboard') }}">← Kembali ke Dashboard</a>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="header">
            <h2>Daftar Pesanan</h2>
        </div>

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-box">
                <div class="number">{{ \App\Models\Pesanan::count() }}</div>
                <div class="label">Total Pesanan</div>
            </div>
            <div class="stat-box">
                <div class="number">{{ \App\Models\Pesanan::where('status', 'pending')->count() }}</div>
                <div class="label">Pending</div>
            </div>
            <div class="stat-box">
                <div class="number">{{ \App\Models\Pesanan::where('status', 'diproses')->count() }}</div>
                <div class="label">Diproses</div>
            </div>
            <div class="stat-box">
                <div class="number">{{ \App\Models\Pesanan::where('status', 'dikirim')->count() }}</div>
                <div class="label">Dikirim</div>
            </div>
            <div class="stat-box">
                <div class="number">{{ \App\Models\Pesanan::where('status', 'selesai')->count() }}</div>
                <div class="label">Selesai</div>
            </div>
            <div class="stat-box">
                <div class="number">{{ \App\Models\Pesanan::where('status_pembayaran', 'belum_bayar')->count() }}</div>
                <div class="label">Belum Bayar</div>
            </div>
        </div>

        <div class="card">
            <!-- Filters -->
            <form method="GET" action="{{ route('admin.pesanan.index') }}">
                <div class="filters">
                    <input type="text" name="search" placeholder="Cari pesanan..." value="{{ request('search') }}">
                    
                    <select name="status">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="dikonfirmasi" {{ request('status') == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>

                    <select name="status_pembayaran">
                        <option value="">Status Pembayaran</option>
                        <option value="belum_bayar" {{ request('status_pembayaran') == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                        <option value="sudah_bayar" {{ request('status_pembayaran') == 'sudah_bayar' ? 'selected' : '' }}>Sudah Bayar</option>
                    </select>

                    <button type="submit">🔍 Filter</button>
                </div>
            </form>

            @if($pesanan->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanan as $item)
                        <tr>
                            <td><strong>#{{ $item->id }}</strong></td>
                            <td>{{ $item->tanggal_pesanan->format('d M Y, H:i') }}</td>
                            <td>
                                <strong>{{ $item->nama_penerima }}</strong><br>
                                <small style="color: #666;">{{ $item->no_telp }}</small>
                            </td>
                            <td><strong>Rp {{ number_format($item->total_pembayaran, 0, ',', '.') }}</strong></td>
                            <td>
                                <span class="badge badge-{{ $item->status }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-{{ $item->status_pembayaran }}">
                                    {{ str_replace('_', ' ', ucfirst($item->status_pembayaran)) }}
                                </span>
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.pesanan.show', $item->id) }}" class="btn btn-info">👁️ Detail</a>
                                    <form action="{{ route('admin.pesanan.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">🗑️</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    {{ $pesanan->links() }}
                </div>
            @else
                <div class="no-data">
                    <h3>Belum ada pesanan</h3>
                    <p>Pesanan dari customer akan muncul di sini</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
