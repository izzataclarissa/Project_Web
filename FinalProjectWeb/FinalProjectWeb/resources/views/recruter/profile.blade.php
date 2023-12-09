@extends('recruter.main')

@section('content')
<style>
    .card {
        max-width: 500px;
        margin: auto;
    }

    .card-body {
        padding: 20px;
    }

    .card-title {
        text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: bold;
    }

    .form-control {
        margin-bottom: 15px;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Profile Penyedia Lamaran</h2>
            <form action="{{ route('recruter.profile.update') }}" method="POST">
                @csrf

                <!-- Nama -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>

                <!-- Tombol Simpan -->
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection