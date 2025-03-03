<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MultipleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('m_kategori')->insert([
            ['kategori_kode' => 'ELC', 'kategori_name' => 'Elektronik'],
            ['kategori_kode' => 'FRN', 'kategori_name' => 'Furniture'],
            ['kategori_kode' => 'CLT', 'kategori_name' => 'Pakaian'],
            ['kategori_kode' => 'FD', 'kategori_name' => 'Makanan'],
            ['kategori_kode' => 'ACC', 'kategori_name' => 'Aksesoris'],
        ]);

        DB::table('m_barang')->insert([
            ['kategori_id' => 1, 'barang_kode' => 'B001', 'barang_nama' => 'Laptop', 'harga_beli' => 7000000, 'harga_jual' => 7500000],
            ['kategori_id' => 1, 'barang_kode' => 'B002', 'barang_nama' => 'Mouse', 'harga_beli' => 50000, 'harga_jual' => 75000],
            ['kategori_id' => 1, 'barang_kode' => 'B003', 'barang_nama' => 'Keyboard', 'harga_beli' => 100000, 'harga_jual' => 150000],
            ['kategori_id' => 2, 'barang_kode' => 'B004', 'barang_nama' => 'Meja', 'harga_beli' => 500000, 'harga_jual' => 600000],
            ['kategori_id' => 2, 'barang_kode' => 'B005', 'barang_nama' => 'Kursi', 'harga_beli' => 300000, 'harga_jual' => 350000],
            ['kategori_id' => 3, 'barang_kode' => 'B006', 'barang_nama' => 'Kaos', 'harga_beli' => 80000, 'harga_jual' => 100000],
            ['kategori_id' => 3, 'barang_kode' => 'B007', 'barang_nama' => 'Celana', 'harga_beli' => 150000, 'harga_jual' => 180000],
            ['kategori_id' => 4, 'barang_kode' => 'B008', 'barang_nama' => 'Roti', 'harga_beli' => 10000, 'harga_jual' => 15000],
            ['kategori_id' => 4, 'barang_kode' => 'B009', 'barang_nama' => 'Susu', 'harga_beli' => 20000, 'harga_jual' => 25000],
            ['kategori_id' => 5, 'barang_kode' => 'B010', 'barang_nama' => 'Jam Tangan', 'harga_beli' => 500000, 'harga_jual' => 550000],
        ]);

        for ($i = 1; $i <= 10; $i++) {
            DB::table('t_stok')->insert([
                'barang_id' => $i,
                'user_id' => 1,
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' => rand(10, 50),
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            DB::table('t_penjualan')->insert([
                'user_id' => 1,
                'pembeli' => 'Pembeli ' . $i,
                'penjualan_kode' => 'TRX00' . $i,
                'penjualan_tanggal' => Carbon::now(),
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            for ($j = 1; $j <= 3; $j++) {
                DB::table('t_penjualan_detail')->insert([
                    'penjualan_id' => $i,
                    'barang_id' => rand(1, 10),
                    'harga' => rand(10000, 500000),
                    'jumlah' => rand(1, 5),
                ]);
            }
        }
    }
}
