<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index(){
        // DB::insert('insert into m_level(level_kode, lavel_name, created_at) values(?, ?, ?)', ['CUS', 'Pelanggan', now()]);
        // return "Insert data baru berhasil";

        // $row = DB::insert('update m_level set lavel_name = ? where level_kode = ?', ['Customer', 'CUS']);
        // return "Update data berhasil. Jumlah data yang di update: ". $row . " baris";

        // $row = DB::delete('delete from m_level where level_kode = ?', ['CUS']);
        // return "Delete data berhasil. Jumlah data yang di hapus: " . $row . " baris";

        $data = DB::select("select * from m_level");
        return view('level', ['data' => $data]);
    }
}
