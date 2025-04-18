<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Token Laravel CSRF untuk permintaan AJAX -->
        <title>{{ config('app.name', 'PWL Laravel Starter Code') }}</title>

        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href={{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}>
        <link rel="stylesheet" href={{ asset('adminlte/dist/css/adminlte.min.css') }}>
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet"
            href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

        @stack('css') <!-- Untuk custom CSS tambahan yang di-push dari masing-masing view -->

    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            @include('layouts.header')

            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{ url('/') }}" class="brand-link">
                    <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">PWL - Stater Code</span>
                </a>

                <!-- Main Sidebar Container -->
                @include('layouts.sidebar')

            </aside>

            <div class="content-wrapper">
                @include('layouts.breadcrumb')

                <section class="content">
                    @yield('content')
                </section>
            </div>

            @include('layouts.footer')

            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
        </div>

        <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- DataTables & Plugins -->
        <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

        <!-- jquery-validation -->
        <script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>

        <!-- SweetAlert2 -->
        <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

        <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

        <script>
            // Untuk mengirimkan token Laravel CSRF pada setiap request ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        <script>
            $(document).on('click', '#btnLogout', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin ingin keluar?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Logout',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('/logout') }}",
                            type: "GET",
                            success: function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Anda telah logout.',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.href = "{{ url('/login') }}";
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Logout',
                                    text: 'Terjadi kesalahan saat logout.',
                                });
                            }
                        });
                    }
                });
            });
        </script>

        @stack('js')

    </body>

</html>
