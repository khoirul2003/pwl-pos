@extends('layouts.template')

@section('content')
    <div class="card shadow-lg rounded">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Halo, {{ Auth::user()->username ?? 'User' }} 👋</h4>
            <button class="btn btn-light btn-sm" onclick="$('#modalEditProfile').modal('show')">
                <i class="fas fa-user-edit"></i> Edit Profil
            </button>
        </div>
        <div class="card-body text-center">
            <div class="mb-4">
                <img src="{{ Auth::user()->photo ? asset('images/' . Auth::user()->photo) : asset('image.png') }}"
                    class="img-thumbnail rounded-circle border border-2 shadow-sm" style="width: 150px; height: 150px; object-fit: cover;"
                    alt="Foto Profil">
            </div>
            <h5 class="mb-1">Selamat datang, <strong>{{ Auth::user()->nama ?? 'User' }}</strong>!</h5>
            <p class="text-muted mb-4">Ini adalah halaman utama dari aplikasi ini.</p>
            <div class="table-responsive mx-auto" style="max-width: 500px;">
                <table class="table table-bordered text-left">
                    <tr>
                        <th style="width: 150px;">Nama</th>
                        <td>{{ Auth::user()->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ Auth::user()->username ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Level</th>
                        <td>{{ Auth::user()->level->lavel_name ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditProfile" tabindex="-1" role="dialog" aria-labelledby="modalEditProfileLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ url('/user/update_profile') }}" method="POST" enctype="multipart/form-data" class="modal-content">
                @csrf
                @method('PUT')
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="modalEditProfileLabel">Edit Profil</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ Auth::user()->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="{{ Auth::user()->username }}" required>
                    </div>
                    <div class="form-group">
                        <label>Foto Profil (Opsional)</label>
                        <input type="file" name="photo" class="form-control-file">
                        @if (Auth::user()->photo)
                            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengganti foto.</small>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
