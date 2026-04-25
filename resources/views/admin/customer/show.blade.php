<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Customer - Admin</title>
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
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .card h3 {
            color: #0d4d4d;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #0d4d4d;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            text-align: center;
            border-left: 4px solid #0d4d4d;
        }

        .stat-card .number {
            font-size: 32px;
            font-weight: bold;
            color: #0d4d4d;
            margin-bottom: 5px;
        }

        .stat-card .label {
            color: #666;
            font-size: 14px;
        }

        .info-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-label {
            font-weight: 600;
            color: #666;
            width: 150px;
        }

        .info-value {
            color: #333;
            flex: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table thead {
            background: #f8f9fa;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
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

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-info {
            background: #17a2b8;
            color: white;
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #999;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>👤 Detail Customer</h1>
        <div>
            <a href="{{ route('admin.customer.index') }}">← Kembali</a>
        </div>
    </nav>

    <div class="container">
        <!-- Statistics -->
        <div class="stats">
            <div class="stat-card">
                <div class="number">{{ $stats['total_pesanan'] }}</div>
                <div class="label">Total Pesanan</div>
            </div>
            <div class="stat-card">
                <div class="number">Rp {{ number_format($stats['total_belanja'], 0, ',', '.') }}</div>
                <div class="label">Total Belanja</div>
            </div>
            <div class="stat-card">
                <div class="number">{{ $stats['pesanan_selesai'] }}</div>
                <div class="label">Pesanan Selesai</div>
            </div>
        </div>

        <!-- Info Customer -->
        <div class="card">
            <h3>📋 Informasi Customer</h3>
            <div class="info-row">
                <div class="info-label">ID Customer</div>
                <div class="info-value"><strong>#{{ $customer->id }}</strong></div>
            </div>
            <div class="info-row">
                <div class="info-label">Nama</div>
                <div class="info-value"><strong>{{ $customer->name }}</strong></div>
            </div>
            <div class="info-row">
                <div class="info-label">Email</div>
                <div class="info-value">{{ $customer->email }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Bergabung</div>
                <div class="info-value">{{ $customer->created_at->format('d M Y, H:i') }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Terakhir Update</div>
                <div class="info-value">{{ $customer->updated_at->format('d M Y, H:i') }}</div>
            </div>
        </div>

        <!-- Riwayat Pesanan -->
        <div class="card">
            <h3>🛒 Riwayat Pesanan</h3>
            
            @if($customer->pesanan->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer->pesanan as $pesanan)
                        <tr>
                            <td><strong>#{{ $pesanan->id }}</strong></td>
                            <td>{{ $pesanan->tanggal_pesanan->format('d M Y') }}</td>
                            <td><strong>Rp {{ number_format($pesanan->total_pembayaran, 0, ',', '.') }}</strong></td>
                            <td>
                                <span class="badge badge-{{ $pesanan->status }}">
                                    {{ ucfirst($pesanan->status) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-{{ $pesanan->status_pembayaran }}">
                                    {{ str_replace('_', ' ', ucfirst($pesanan->status_pembayaran)) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.pesanan.show', $pesanan->id) }}" class="btn btn-info">
                                    👁️ Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="no-data">
                    <p>Customer ini belum memiliki riwayat pesanan</p>
                </div>
            @endif
        </div>

        <!-- Actions -->
        <div class="card">
            <div class="actions">
                <a href="{{ route('admin.customer.index') }}" class="btn btn-secondary">← Kembali ke Daftar</a>
                @if($customer->pesanan->count() == 0)
                    <form action="{{ route('admin.customer.destroy', $customer->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus customer ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">🗑️ Hapus Customer</button>
                    </form>
                @else
                    <button class="btn btn-danger" disabled style="opacity: 0.5; cursor: not-allowed;" title="Tidak dapat menghapus customer yang memiliki riwayat pesanan">
                        🗑️ Hapus Customer
                    </button>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
