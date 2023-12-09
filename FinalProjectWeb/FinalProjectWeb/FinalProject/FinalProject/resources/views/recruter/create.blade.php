@extends('recruter.main')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Job Post Form</h2>

    <form action="{{ route('recruter.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
            <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}" required>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="gambar" name="gambar" required>
        </div>

        <div class="mb-3">
            <label for="posisi" class="form-label">Posisi</label>
            <input type="text" class="form-control" id="posisi" name="posisi" value="{{ old('posisi') }}" required>
        </div>

        <div class="mb-3">
            <label for="pendidikan" class="form-label">Pendidikan Minimal</label>
            <input type="text" class="form-control" id="pendidikan" name="pendidikan" value="{{ old('pendidikan') }}" required>
        </div>

        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" required>
        </div>

        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe</label>
            <select class="form-select" id="tipe" name="tipe" required>
                <option value="part time">Part Time</option>
                <option value="full time">Full Time</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="hpemail" class="form-label">Nomor HP/Email</label>
            <input type="text" class="form-control" id="hpemail" name="hpemail" value="{{ old('hpemail') }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" value="{{ old('deskripsi') }}" required></textarea>
        </div>

        <div class="mb-3">
            <label for="gaji" class="form-label">Gaji</label>
            <input type="number" class="form-control" id="gaji" name="gaji" value="{{ old('gaji') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>

@endsection