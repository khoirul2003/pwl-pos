<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Register Pengguna</title>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    </head>

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center"><a href="{{ url('/') }}" class="h1"><b>Admin</b>LTE</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Create your account</p>
                    <form action="{{ url('register') }}" method="POST" id="form-register">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" id="username" name="username" class="form-control"
                                placeholder="Username" required>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-user"></span></div>
                            </div>
                            <small id="error-username" class="error-text text-danger"></small>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" id="nama" name="nama" class="form-control"
                                placeholder="Full Name" required>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-user"></span></div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-lock"></span></div>
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-12">
                                <select class="form-control" id="level_id" name="level_id" required>
                                    <option value="">- Pilih Level -</option>
                                    @foreach ($levels as $item)
                                        <option value="{{ $item->level_id }}">{{ $item->lavel_name }}</option>
                                    @endforeach
                                </select>
                                @error('level_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                            </div>
                            <div class="col-12 mt-2 text-center">
                                <a href="{{ url('register') }}" class="text-center">Sudah punya akun?</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                $('#form-register').on('submit', function(e) {
                    e.preventDefault();
                    var form = $(this);
                    $.ajax({
                        url: form.attr('action'),
                        method: form.attr('method'),
                        data: form.serialize(),
                        success: function(response) {
                            if (response.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                }).then(function() {
                                    window.location = response.redirect;
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message,
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log("AJAX ERROR: ", xhr.responseText);
                            console.log("Status: ", status);
                            console.log("Error: ", error);

                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: 'Terjadi kesalahan di server. Coba lagi.',
                            });
                        }
                    });
                });
            });
        </script>
    </body>

</html>
