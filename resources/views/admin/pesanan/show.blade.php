<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #{{ $pesanan->id }} - Admin</title>
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
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px;
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

        .card h3 {
            color: #0d4d4d;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #0d4d4d;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .info-row {
            display: flex;
            padding: 10px 0;
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

        .produk-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }

        .form-group select,
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            font-size: 14px;
        }

        .btn-primary {
            background: #0d4d4d;
            color: white;
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
            text-decoration: none;
            display: inline-block;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .total-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
        }

        .total-row.grand {
            font-size: 18px;
            font-weight: bold;
            color: #0d4d4d;
            border-top: 2px solid #0d4d4d;
            padding-top: 15px;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>🛒 Detail Pesanan #{{ $pesanan->id }}</h1>
        <div>
            <a href="{{ route('admin.pesanan.index') }}">← Kembali</a>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid-2">
            <!-- Info Pesanan -->
            <div class="card">
                <h3>📋 Informasi Pesanan</h3>
                <div class="info-row">
                    <div class="info-label">ID Pesanan</div>
                    <div class="info-value"><strong>#{{ $pesanan->id }}</strong></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal</div>
                    <div class="info-value">{{ $pesanan->tanggal_pesanan->format('d M Y, H:i') }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Status</div>
                    <div class="info-value">
                        <span class="badge badge-{{ $pesanan->status }}">
                            {{ ucfirst($pesanan->status) }}
                        </span>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Pembayaran</div>
                    <div class="info-value">
                        <span class="badge badge-{{ $pesanan->status_pembayaran }}">
                            {{ str_replace('_', ' ', ucfirst($pesanan->status_pembayaran)) }}
                        </span>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Metode</div>
                    <div class="info-value">{{ $pesanan->metode_pembayaran ?? '-' }}</div>
                </div>
            </div>

            <!-- Info Pelanggan -->
            <div class="card">
                <h3>👤 Informasi Pelanggan</h3>
                <div class="info-row">
                    <div class="info-label">Nama</div>
                    <div class="info-value"><strong>{{ $pesanan->nama_penerima }}</strong></div>
                </div>
                <div class="info-row">
                    <div class="info-label">No. Telepon</div>
                    <div class="info-value">{{ $pesanan->no_telp }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $pesanan->user->email ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Alamat</div>
                    <div class="info-value">
                        {{ $pesanan->alamat_lengkap }}<br>
                        {{ $pesanan->kota }}, {{ $pesanan->provinsi }} {{ $pesanan->kode_pos }}
                        @if($pesanan->patokan)
                            <br><small style="color: #666;">Patokan: {{ $pesanan->patokan }}</small>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengiriman -->
        <div class="card">
            <h3>🚚 Informasi Pengiriman</h3>
            <div class="grid-2">
                <div>
                    <div class="info-row">
                        <div class="info-label">Kurir</div>
                        <div class="info-value"><strong>{{ $pesanan->kurir }}</strong></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Layanan</div>
                        <div class="info-value">{{ $pesanan->layanan_kurir }}</div>
                    </div>
                </div>
                <div>
                    <div class="info-row">
                        <div class="info-label">Biaya</div>
                        <div class="info-value">Rp {{ number_format($pesanan->biaya_pengiriman, 0, ',', '.') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">No. Resi</div>
                        <div class="info-value">{{ $pesanan->resi ?? 'Belum ada' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produk -->
        <div class="card">
            <h3>📦 Produk yang Dipesan</h3>
            <table>
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Varian</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pesanan->items as $item)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                @if($item->produk && $item->produk->gambar)
                                    <img src="{{ asset('storage/' . $item->produk->gambar) }}" alt="{{ $item->nama_produk }}" class="produk-img">
                                @endif
                                <strong>{{ $item->nama_produk }}</strong>
                            </div>
                        </td>
                        <td>{{ $item->varian }}</td>
                        <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td><strong>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total-box">
                <div class="total-row">
                    <span>Subtotal Produk:</span>
                    <span>Rp {{ number_format($pesanan->subtotal_produk, 0, ',', '.') }}</span>
                </div>
                <div class="total-row">
                    <span>Biaya Pengiriman:</span>
                    <span>Rp {{ number_format($pesanan->biaya_pengiriman, 0, ',', '.') }}</span>
                </div>
                <div class="total-row">
                    <span>Biaya Penanganan:</span>
                    <span>Rp {{ number_format($pesanan->biaya_penanganan, 0, ',', '.') }}</span>
                </div>
                <div class="total-row grand">
                    <span>Total Pembayaran:</span>
                    <span>Rp {{ number_format($pesanan->total_pembayaran, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Update Status -->
        <div class="grid-2">
            <div class="card">
                <h3>🔄 Update Status Pesanan</h3>
                <form action="{{ route('admin.pesanan.updateStatus', $pesanan->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Status Pesanan</label>
                        <select name="status" required>
                            <option value="pending" {{ $pesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="dikonfirmasi" {{ $pesanan->status == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                            <option value="diproses" {{ $pesanan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="dikirim" {{ $pesanan->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                            <option value="selesai" {{ $pesanan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="dibatalkan" {{ $pesanan->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No. Resi (Opsional)</label>
                        <input type="text" name="resi" value="{{ $pesanan->resi }}" placeholder="Masukkan nomor resi">
                    </div>
                    <button type="submit" class="btn btn-primary">💾 Update Status</button>
                </form>
            </div>

            <div class="card">
                <h3>💰 Update Status Pembayaran</h3>
                <form action="{{ route('admin.pesanan.updatePembayaran', $pesanan->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Status Pembayaran</label>
                        <select name="status_pembayaran" required>
                            <option value="belum_bayar" {{ $pesanan->status_pembayaran == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                            <option value="sudah_bayar" {{ $pesanan->status_pembayaran == 'sudah_bayar' ? 'selected' : '' }}>Sudah Bayar</option>
                        </select>
                    </div>
                    @if($pesanan->bukti_pembayaran)
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; font-weight: 600; margin-bottom: 8px;">Bukti Pembayaran:</label>
                            <img src="{{ asset('storage/' . $pesanan->bukti_pembayaran) }}" alt="Bukti Pembayaran" style="max-width: 100%; border-radius: 8px; border: 2px solid #e0e0e0;">
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary">💾 Update Pembayaran</button>
                </form>
            </div>
        </div>

        <!-- Actions -->
        <div class="card">
            <div class="actions">
                <a href="{{ route('admin.pesanan.index') }}" class="btn btn-secondary">← Kembali ke Daftar</a>
                <form action="{{ route('admin.pesanan.destroy', $pesanan->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">🗑️ Hapus Pesanan</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
