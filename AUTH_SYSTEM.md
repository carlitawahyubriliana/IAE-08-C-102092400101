# 🔐 Sistem Autentikasi Agro Jamur Pabuwaran

## Deskripsi
Sistem autentikasi dengan 2 role: **Admin** dan **Customer**

## ✅ Fitur yang Sudah Dibuat

### 1. **Tabel Users**
- Kolom: id, nama, email, password, role, telepon, timestamps
- Role: `admin` dan `customer`

### 2. **Middleware**
- `IsAdmin`: Memastikan hanya admin yang bisa mengakses route admin
- Terdaftar sebagai `admin` di Kernel.php

### 3. **Controller**
- `AuthController`: Handle login, register, dan logout
- Validasi form
- Redirect berdasarkan role setelah login

### 4. **Routes**
```php
// Public
GET  /                  -> Halaman utama

// Auth (Guest only)
GET  /login            -> Form login
POST /login            -> Proses login
GET  /register         -> Form register
POST /register         -> Proses register

// Authenticated
POST /logout           -> Logout

// Customer (Auth required)
GET  /dashboard        -> Dashboard customer

// Admin (Auth + Admin middleware)
GET  /admin/dashboard  -> Dashboard admin
```

### 5. **Views**
- `resources/views/auth/login.blade.php` - Halaman login
- `resources/views/auth/register.blade.php` - Halaman register
- `resources/views/admin/dashboard.blade.php` - Dashboard admin

### 6. **Default Accounts (Seeder)**
```
👤 Admin
Email: admin@agrojamur.com
Password: admin123

👤 Customer Test
Email: customer@test.com
Password: customer123
```

## 🚀 Cara Menggunakan

### 1. Login sebagai Admin
1. Buka `/login`
2. Email: `admin@agrojamur.com`
3. Password: `admin123`
4. Akan diarahkan ke `/admin/dashboard`

### 2. Login sebagai Customer
1. Buka `/login`
2. Email: `customer@test.com`
3. Password: `customer123`
4. Akan diarahkan ke `/dashboard`

### 3. Register Akun Baru
1. Buka `/register`
2. Isi form registrasi
3. Akun otomatis mendapat role `customer`
4. Auto login setelah register

## 🔒 Keamanan

### Password Hashing
- Password di-hash menggunakan `Hash::make()`
- Tidak tersimpan plain text di database

### Middleware Protection
- Route admin dilindungi `auth` + `admin` middleware
- Route customer dilindungi `auth` middleware
- Guest routes hanya bisa diakses saat belum login

### Session Management
- Session regeneration setelah login
- Session invalidate saat logout
- Remember me feature tersedia

## 📝 Model Relationships

### User Model
```php
// Relasi
public function pesanan()
{
    return $this->hasMany(Pesanan::class);
}

// Fillable
protected $fillable = [
    'nama', 'email', 'password', 'role', 'telepon'
];
```

## 🎯 Flow Autentikasi

### Register Flow
1. User mengisi form register
2. Validasi data (nama, email unique, password min 6, password confirmation)
3. Create user dengan role `customer`
4. Auto login
5. Redirect ke `/dashboard`

### Login Flow
1. User input email & password
2. Validasi credentials
3. Check role:
   - Admin → redirect `/admin/dashboard`
   - Customer → redirect `/dashboard`
4. Session regenerate

### Logout Flow
1. User klik logout
2. Auth::logout()
3. Session invalidate & regenerate token
4. Redirect ke `/login`

## 🛡️ Middleware Usage

### Protecting Routes
```php
// Hanya authenticated users
Route::middleware(['auth'])->group(function () {
    // routes here
});

// Hanya admin
Route::middleware(['auth', 'admin'])->group(function () {
    // admin routes here
});
```

## 📊 Statistik Dashboard Admin
- Total Produk
- Total Pesanan
- Pesanan Pending
- Total Customer

## 🎨 Design
- Responsive design
- Gradient background (#0d4d4d to #1a7373)
- Modern UI dengan border radius
- Hover effects
- Alert messages untuk feedback

## 🔄 Redirect Logic
- Guest mengakses protected route → redirect `/login`
- Non-admin mengakses admin route → redirect home + error message
- Authenticated user mengakses login/register → redirect intended page
- After login: Admin → `/admin/dashboard`, Customer → `/dashboard`
