<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk - Admin</title>
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

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h2 {
            color: #0d4d4d;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #0d4d4d;
            color: white;
        }

        .btn-primary:hover {
            background: #1a7373;
        }

        .btn-warning {
            background: #f39c12;
            color: white;
            font-size: 14px;
            padding: 8px 15px;
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
            font-size: 14px;
            padding: 8px 15px;
        }

        .btn-info {
            background: #3498db;
            color: white;
            font-size: 14px;
            padding: 8px 15px;
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
        }

        table tbody tr:hover {
            background: #f9f9f9;
        }

        .produk-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-tiram_putih {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .badge-tiram_coklat {
            background: #efebe9;
            color: #5d4037;
        }

        .badge-kuping {
            background: #fce4ec;
            color: #c2185b;
        }

        .badge-kancing {
            background: #fff3e0;
            color: #e65100;
        }

        .actions {
            display: flex;
            gap: 5px;
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

        .varian-info {
            font-size: 12px;
            color: #666;
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
        <h1>🍄 Kelola Produk</h1>
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
            <h2>Daftar Produk</h2>
            <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">+ Tambah Produk</a>
        </div>

        <div class="card">
            @if($produk->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Rating</th>
                            <th>Terjual</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produk as $item)
                        <tr>
                            <td>
                                @if($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="produk-img">
                                @else
                                    <div class="produk-img" style="background: #ddd;"></div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $item->nama }}</strong>
                            </td>
                            <td>
                                <div class="varian-info">
                                    @if($item->harga_250gr)
                                        <div>250gr: Rp {{ number_format($item->harga_250gr, 0, ',', '.') }}</div>
                                    @endif
                                    @if($item->harga_500gr)
                                        <div>500gr: Rp {{ number_format($item->harga_500gr, 0, ',', '.') }}</div>
                                    @endif
                                    @if($item->harga_1kg)
                                        <div>1kg: Rp {{ number_format($item->harga_1kg, 0, ',', '.') }}</div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="varian-info">
                                    <div>250gr: {{ $item->stok_250gr }}</div>
                                    <div>500gr: {{ $item->stok_500gr }}</div>
                                    <div>1kg: {{ $item->stok_1kg }}</div>
                                </div>
                            </td>
                            <td>⭐ {{ $item->rating }}/5</td>
                            <td>{{ $item->jumlah_terjual }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.produk.show', $item->id) }}" class="btn btn-info">👁️</a>
                                    <a href="{{ route('admin.produk.edit', $item->id) }}" class="btn btn-warning">✏️</a>
                                    <form action="{{ route('admin.produk.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
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
                    {{ $produk->links() }}
                </div>
            @else
                <div class="no-data">
                    <h3>Belum ada produk</h3>
                    <p>Silakan tambah produk baru</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
