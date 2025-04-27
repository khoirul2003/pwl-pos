@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Barang</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/barang/import') }}')" class="btn btn-info">Import Barang</button>
                <a href="{{ url('/barang/export_excel') }}" class="btn btn-primary"><i class="fa fa-fileexcel"></i> Export Barang</a>
                <a href="{{ url('/barang/export_pdf') }}" class="btn btn-warning"><i class="fa fa-filepdf"></i> Export Barang (PDF)</a>
                <button onclick="modalAction('{{ url('/barang/create') }}')" class="btn btn-success">Tambah Data</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('showModal'))
                <script>
                    $(document).ready(function() {
                        modalAction('{{ url('/barang/' . session('barang_id')) }}');
                    });
                </script>
            @endif

            <table class="table table-bordered table-sm table-striped table-hover" id="table-barang">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <div id="myModal" class="modal fade animate shake" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="75%"></div>
@endsection

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        var tableBarang;
        $(document).ready(function() {
            tableBarang = $('#table-barang').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('barang/list') }}",
                    dataType: "json",
                    type: "POST",
                    data: function(d) {
                        d.filter_kategori = $('.filter_kategori').val();
                    }
                },
                columns: [
                    { data: "barang_id", className: "text-center", width: "5%", orderable: false, searchable: false },
                    {
                        data: "image",
                        className: "text-center",
                        width: "10%",
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            let image = data ? data : 'images/default-product.png';
                            return `<img src="{{ asset('') }}${image}" width="60" class="img-thumbnail">`;
                        }
                    },
                    { data: "barang_kode", className: "", width: "10%", orderable: true, searchable: true },
                    { data: "barang_nama", className: "", width: "24%", orderable: true, searchable: true },
                    {
                        data: "harga_beli",
                        className: "",
                        width: "10%",
                        orderable: true,
                        searchable: false,
                        render: function(data) { return new Intl.NumberFormat('id-ID').format(data); }
                    },
                    {
                        data: "harga_jual",
                        className: "",
                        width: "10%",
                        orderable: true,
                        searchable: false,
                        render: function(data) { return new Intl.NumberFormat('id-ID').format(data); }
                    },
                    { data: "kategori.kategori_name", className: "", width: "14%", orderable: true, searchable: false },
                    { data: "aksi", className: "text-center", width: "21%", orderable: false, searchable: false }
                ]
            });

            $('#table-barang_filter input').unbind().bind().on('keyup', function(e) {
                if (e.keyCode == 13) {
                    tableBarang.search(this.value).draw();
                }
            });

            $('.filter_kategori').change(function() {
                tableBarang.draw();
            });
        });
    </script>
@endpush
