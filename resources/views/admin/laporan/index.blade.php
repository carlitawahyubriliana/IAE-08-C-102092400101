<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            background: white;
            padding: 20px 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .header h2 {
            color: #0d4d4d;
        }

        .filter-form {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .filter-form select {
            padding: 10px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
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

        .btn-primary {
            background: #0d4d4d;
            color: white;
        }

        .btn-success {
            background: #28a745;
            color: white;
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

        .stat-card.revenue {
            border-left-color: #28a745;
        }

        .stat-card.orders {
            border-left-color: #007bff;
        }

        .stat-card.completed {
            border-left-color: #17a2b8;
        }

        .stat-card.customers {
            border-left-color: #ffc107;
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
            margin-bottom: 5px;
        }

        .stat-card .subtitle {
            color: #999;
            font-size: 12px;
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
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #0d4d4d;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
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

        table th {
            font-weight: 600;
            color: #666;
        }

        .chart-container {
            position: relative;
            height: 300px;
            margin-top: 20px;
        }

        .badge {
            padding: 5px 12px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .badge-primary {
            background: #cfe2ff;
            color: #084298;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
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
        <h1>📊 Laporan Penjualan</h1>
        <div>
            <a href="{{ route('admin.dashboard') }}">← Dashboard</a>
        </div>
    </nav>

    <div class="container">
        <!-- Header dengan Filter -->
        <div class="header">
            <h2>Periode: {{ ucfirst(str_replace('_', ' ', $periode)) }}</h2>
            <form method="GET" class="filter-form">
                <select name="periode" onchange="this.form.submit()">
                    <option value="hari_ini" {{ $periode == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                    <option value="minggu_ini" {{ $periode == 'minggu_ini' ? 'selected' : '' }}>Minggu Ini</option>
                    <option value="bulan_ini" {{ $periode == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
                    <option value="bulan_lalu" {{ $periode == 'bulan_lalu' ? 'selected' : '' }}>Bulan Lalu</option>
                    <option value="tahun_ini" {{ $periode == 'tahun_ini' ? 'selected' : '' }}>Tahun Ini</option>
                </select>
            </form>
        </div>

        <!-- Statistik Utama -->
        <div class="stats">
            <div class="stat-card revenue">
                <h3>💰 Total Penjualan</h3>
                <div class="number">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</div>
                <div class="subtitle">{{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}</div>
            </div>
            <div class="stat-card orders">
                <h3>🛒 Total Pesanan</h3>
                <div class="number">{{ $totalPesanan }}</div>
                <div class="subtitle">Pesanan masuk</div>
            </div>
            <div class="stat-card completed">
                <h3>✅ Pesanan Selesai</h3>
                <div class="number">{{ $pesananSelesai }}</div>
                <div class="subtitle">Transaksi berhasil</div>
            </div>
            <div class="stat-card customers">
                <h3>👥 Customer Baru</h3>
                <div class="number">{{ $customerBaru }}</div>
                <div class="subtitle">Registrasi baru</div>
            </div>
        </div>

        <!-- Grafik Penjualan -->
        <div class="card">
            <h3>📈 Grafik Penjualan (7 Hari Terakhir)</h3>
            <div class="chart-container">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Produk & Kategori Terlaris -->
        <div class="grid-2">
            <!-- Produk Terlaris -->
            <div class="card">
                <h3>🏆 Produk Terlaris</h3>
                @if($produkTerlaris->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Produk</th>
                                <th>Varian</th>
                                <th>Terjual</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produkTerlaris as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $item->nama }}</strong></td>
                                <td><span class="badge badge-primary">{{ $item->varian }}</span></td>
                                <td>{{ $item->total_terjual }} pcs</td>
                                <td><strong>Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}</strong></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p style="text-align: center; color: #999; padding: 20px;">Belum ada data penjualan</p>
                @endif
            </div>

            <!-- Kategori Terlaris -->
            <div class="card">
                <h3>📦 Kategori Terlaris</h3>
                @if($kategoriTerlaris->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Total Terjual</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kategoriTerlaris as $item)
                            <tr>
                                <td><strong>{{ ucfirst($item->kategori) }}</strong></td>
                                <td>{{ $item->total_terjual }} pcs</td>
                                <td><strong>Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}</strong></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p style="text-align: center; color: #999; padding: 20px;">Belum ada data penjualan</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Data untuk grafik
        const dates = @json($penjualanHarian->pluck('tanggal'));
        const totals = @json($penjualanHarian->pluck('total'));
        const orders = @json($penjualanHarian->pluck('jumlah_pesanan'));

        // Format tanggal
        const labels = dates.map(date => {
            const d = new Date(date);
            return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
        });

        // Buat grafik
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Penjualan (Rp)',
                    data: totals,
                    borderColor: '#0d4d4d',
                    backgroundColor: 'rgba(13, 77, 77, 0.1)',
                    tension: 0.4,
                    fill: true,
                    yAxisID: 'y'
                }, {
                    label: 'Jumlah Pesanan',
                    data: orders,
                    borderColor: '#28a745',
                    backgroundColor: 'rgba(40, 167, 69, 0.1)',
                    tension: 0.4,
                    fill: true,
                    yAxisID: 'y1'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.datasetIndex === 0) {
                                    label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                } else {
                                    label += context.parsed.y + ' pesanan';
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        grid: {
                            drawOnChartArea: false,
                        },
                    }
                }
            }
        });
    </script>
</body>
</html>
