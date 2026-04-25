<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Admin</title>
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
            max-width: 800px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .card h2 {
            color: #0d4d4d;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #0d4d4d;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-group .error {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .file-input-label {
            display: block;
            padding: 12px;
            background: #f8f9fa;
            border: 2px dashed #0d4d4d;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .file-input-label:hover {
            background: #e9ecef;
        }

        .current-img {
            max-width: 200px;
            margin-bottom: 10px;
            border-radius: 8px;
            border: 2px solid #e0e0e0;
        }

        .preview-img {
            max-width: 200px;
            margin-top: 10px;
            border-radius: 8px;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: all 0.3s;
            font-size: 14px;
        }

        .btn-primary {
            background: #0d4d4d;
            color: white;
        }

        .btn-primary:hover {
            background: #1a7373;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .info-text {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>🍄 Edit Produk</h1>
        <div>
            <a href="{{ route('admin.produk.index') }}">← Kembali</a>
        </div>
    </nav>

    <div class="container">
        <div class="card">
            <h2>Edit Produk: {{ $produk->nama }}</h2>

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong>
                    <ul style="margin: 10px 0 0 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama">Nama Produk *</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $produk->nama) }}" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Produk *</label>
                    <textarea id="deskripsi" name="deskripsi" required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                    <div class="info-text">Jelaskan keunggulan dan manfaat produk</div>
                </div>

                <div class="form-group">
                    <label>Gambar Produk</label>
                    @if($produk->gambar)
                        <div>
                            <p style="font-size: 14px; color: #666; margin-bottom: 8px;">Gambar saat ini:</p>
                            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}" class="current-img">
                        </div>
                    @endif
                    <div class="file-input-wrapper">
                        <input type="file" id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">
                        <label for="gambar" class="file-input-label">
                            📷 Klik untuk upload gambar baru<br>
                            <span style="font-size: 12px; color: #666;">Max 2MB (JPG, PNG, GIF) - Opsional</span>
                        </label>
                    </div>
                    <img id="preview" class="preview-img" style="display: none;">
                </div>

                <div class="form-group">
                    <label>Harga per Varian</label>
                    <div class="form-row">
                        <div>
                            <input type="number" name="harga_250gr" placeholder="Harga 250gr" value="{{ old('harga_250gr', $produk->harga_250gr) }}" min="0">
                            <div class="info-text">250 gram</div>
                        </div>
                        <div>
                            <input type="number" name="harga_500gr" placeholder="Harga 500gr" value="{{ old('harga_500gr', $produk->harga_500gr) }}" min="0">
                            <div class="info-text">500 gram</div>
                        </div>
                        <div>
                            <input type="number" name="harga_1kg" placeholder="Harga 1kg" value="{{ old('harga_1kg', $produk->harga_1kg) }}" min="0">
                            <div class="info-text">1 kilogram</div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Stok per Varian *</label>
                    <div class="form-row">
                        <div>
                            <input type="number" name="stok_250gr" placeholder="Stok 250gr" value="{{ old('stok_250gr', $produk->stok_250gr) }}" min="0" required>
                            <div class="info-text">250 gram</div>
                        </div>
                        <div>
                            <input type="number" name="stok_500gr" placeholder="Stok 500gr" value="{{ old('stok_500gr', $produk->stok_500gr) }}" min="0" required>
                            <div class="info-text">500 gram</div>
                        </div>
                        <div>
                            <input type="number" name="stok_1kg" placeholder="Stok 1kg" value="{{ old('stok_1kg', $produk->stok_1kg) }}" min="0" required>
                            <div class="info-text">1 kilogram</div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">💾 Update Produk</button>
                    <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
