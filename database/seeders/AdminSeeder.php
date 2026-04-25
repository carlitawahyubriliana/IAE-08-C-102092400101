<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat akun admin default
        User::create([
            'nama' => 'Admin Agro Jamur',
            'email' => 'admin@agrojamur.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'telepon' => '0821-3848-7484',
        ]);

        // Membuat akun customer untuk testing
        User::create([
            'nama' => 'Briella',
            'email' => 'customer@test.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
            'telepon' => '0897-654-321',
        ]);

        echo "✅ Admin dan Customer test berhasil dibuat!\n";
        echo "📧 Admin - Email: admin@agrojamur.com | Password: admin123\n";
        echo "📧 Customer - Email: customer@test.com | Password: customer123\n";
    }
}
