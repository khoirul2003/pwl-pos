<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'kategori' => DB::select("SELECT * FROM m_kategori"),
            'barang' => DB::select("SELECT * FROM m_barang"),
            'stok' => DB::select("SELECT * FROM t_stok"),
            'penjualan' => DB::select("SELECT * FROM t_penjualan"),
            'penjualan_detail' => DB::select("SELECT * FROM t_penjualan_detail"),
        ];

        return response()->json($data);
    }
}
