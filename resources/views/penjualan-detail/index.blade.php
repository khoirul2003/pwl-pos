@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('penjualan-detail/create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan_detail">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pembeli</th>
                        <th>Kode Penjualan</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Nama Kategori</th>
                        <th>Tanggal</th>
                        <th>Harga Jual</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    @endsection

    @push('css')
    @endpush

    @push('js')
        <script>
            $(document).ready(function() {
                $('#table_penjualan_detail').DataTable({
                    ajax: {
                        "url": "{{ url('penjualan-detail/list') }}",
                        "dataType": "json",
                        "type": "POST",
                    },
                    columns: [{
                            data: "DT_RowIndex",
                            className: "text-center",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "pembeli",
                            className: "",
                            orderable: true
                        },
                        {
                            data: "penjualan_kode",
                            className: "",
                            orderable: true
                        },
                        {
                            data: "barang_kode",
                            className: "",
                            orderable: true
                        },
                        {
                            data: "barang_nama",
                            className: "",
                            orderable: true
                        },
                        {
                            data: "kategori_name",
                            className: "",
                            orderable: true
                        },
                        {
                            data: "penjualan_tanggal",
                            className: "",
                            orderable: true
                        },
                        {
                            data: "harga_jual",
                            className: "text-right",
                            orderable: true
                        },
                        {
                            data: "jumlah",
                            className: "text-center",
                            orderable: true
                        },
                        {
                            data: "harga",
                            className: "text-right",
                            orderable: true
                        },
                        {
                            data: "aksi",
                            className: "text-center",
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
            });
        </script>
    @endpush
