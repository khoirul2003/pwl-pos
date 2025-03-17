<?php

namespace App\Http\Controllers;

use App\Models\PenjualanDetailModel;
use App\Models\PenjualanModel;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;

class PenjualanDetailController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Detail Penjualan',
            'list' => ['Home', 'Penjualan Detail']
        ];

        $page = (object) [
            'title' => 'Daftar detail penjualan'
        ];

        $activeMenu = 'penjualan-detail';

        return view('penjualan-detail.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $details = PenjualanDetailModel::select('detail_id', 'penjualan_id', 'barang_id', 'harga', 'jumlah')
            ->with(['penjualan', 'barang.kategori']);

        return DataTables::of($details)
            ->addIndexColumn()
            ->editColumn('pembeli', fn($detail) => $detail->penjualan->pembeli ?? '-')
            ->editColumn('penjualan_kode', fn($detail) => $detail->penjualan->penjualan_kode ?? '-')
            ->editColumn('barang_kode', fn($detail) => $detail->barang->barang_kode ?? '-')
            ->editColumn('barang_nama', fn($detail) => $detail->barang->barang_nama ?? '-')
            ->editColumn('kategori_name', fn($detail) => $detail->barang->kategori->kategori_name ?? '-')
            ->editColumn('penjualan_tanggal', fn($detail) => $detail->penjualan->penjualan_tanggal ?? '-')
            ->editColumn('harga_jual', fn($detail) => number_format($detail->barang->harga_jual, 0, ',', '.'))
            ->addColumn('aksi', function ($detail) {
                return '<a href="' . url('/penjualan-detail/' . $detail->detail_id) . '" class="btn btn-info btn-sm">Detail</a> '
                    . '<a href="' . url('/penjualan-detail/' . $detail->detail_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> '
                    . '<form class="d-inline-block" method="POST" action="' . url('/penjualan-detail/' . $detail->detail_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Detail Penjualan',
            'list' => ['Home', 'Penjualan Detail', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah detail penjualan'
        ];

        $penjualan = PenjualanModel::all();
        $barang = BarangModel::all();
        $activeMenu = 'penjualan-detail';

        return view('penjualan-detail.create', compact('breadcrumb', 'page', 'penjualan', 'barang', 'activeMenu'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:t_penjualan,penjualan_id',
            'barang_id' => 'required|exists:m_barang,barang_id',
            'harga' => 'required|numeric|min:1',
            'jumlah' => 'required|integer|min:1'
        ]);

        PenjualanDetailModel::create([
            'penjualan_id' => $request->penjualan_id,
            'barang_id' => $request->barang_id,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
        ]);

        return redirect('/penjualan-detail')->with('success', 'Data detail penjualan berhasil disimpan');
    }


    public function show(string $id)
    {
        $detail = PenjualanDetailModel::with(['penjualan', 'barang.kategori'])->find($id);

        if (!$detail) {
            return redirect('/penjualan-detail')->with('error', 'Data tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Penjualan Detail', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail penjualan'
        ];

        $activeMenu = 'penjualan-detail';

        return view('penjualan-detail.show', compact('breadcrumb', 'page', 'detail', 'activeMenu'));
    }

    public function edit(string $id)
    {
        $detail = PenjualanDetailModel::find($id);
        $penjualan = PenjualanModel::all();
        $barang = BarangModel::all();

        if (!$detail) {
            return redirect('/penjualan-detail')->with('error', 'Data tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Detail Penjualan',
            'list' => ['Home', 'Penjualan Detail', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit detail penjualan'
        ];

        $activeMenu = 'penjualan-detail';

        return view('penjualan-detail.edit', compact('breadcrumb', 'page', 'detail', 'penjualan', 'barang', 'activeMenu'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:t_penjualan,penjualan_id',
            'barang_id' => 'required|exists:m_barang,barang_id',
            'harga' => 'required|numeric',
            'jumlah' => 'required|integer|min:1'
        ]);

        $detail = PenjualanDetailModel::find($id);
        if (!$detail) {
            return redirect('/penjualan-detail')->with('error', 'Data tidak ditemukan');
        }

        $detail->update($request->all());

        return redirect('/penjualan-detail')->with('success', 'Data detail penjualan berhasil diubah');
    }

    public function destroy(string $id)
    {
        if (!PenjualanDetailModel::find($id)) {
            return redirect('/penjualan-detail')->with('error', 'Data tidak ditemukan');
        }

        try {
            PenjualanDetailModel::destroy($id);
            return redirect('/penjualan-detail')->with('success', 'Data berhasil dihapus');
        } catch (QueryException $e) {
            return redirect('/penjualan-detail')->with('error', 'Data gagal dihapus karena masih terkait dengan data lain');
        }
    }
}
