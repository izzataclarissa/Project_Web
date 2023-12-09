@extends('recruter.main')

@section('content')
<div class="row">
    <div class="col-lg-8">
        @if (session('message'))
        <div class="alert alert-{{ session('alert-type') }} alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
        <div class="card">
            <div class="card-header">
                Form Edit Job Post
            </div>
            <div class="card-body">
                <form action="{{ route('recruter.update', $jobpost->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_perusahaan">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" class="form-control"
                            value="{{ old('nama_perusahaan', $jobpost->nama_perusahaan) }}">
                    </div>
                    <div class="form-group">
                        <label for="posisi">Posisi</label>
                        <input type="number" name="posisi" class="form-control"
                            value="{{ old('posisi', $jobpost->posisi) }}">
                    </div>
                    <div class="form-group">
                        <label for="pendidikan">Pendidikan Minimal</label>
                        <input type="text" name="pendidikan" class="form-control"
                            value="{{ old('pendidikan', $jobpost->pendidikan) }}">
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input type="number" name="lokasi" class="form-control"
                            value="{{ old('lokasi', $jobpost->lokasi) }}">
                    </div>
                    <div class="form-group">
                        <label for="tipe">Tipe</label>
                        <select name="tipe" id="tipe" class="form-control">
                            <option {{ $jobpost->tipe == 'part time' ? 'selected' : null }} value="part time">Part Time</option>
                            <option {{ $jobpost->tipe == 'full time' ? 'selected' : null }} value="full time">Full Time</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hpemail">Nomor Hp/Email</label>
                        <input type="number" name="hpemail" class="form-control"
                            value="{{ old('hpemail', $jobpost->hpemail) }}">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $jobpost->deskripsi) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="gaji">Gaji</label>
                        <input type="number" name="gaji" class="form-control"
                            value="{{ old('gaji', $jobpost->gaji) }}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-header">
            Form Edit Gambar
        </div>
        <div class="card-body">
            <form action="{{ route('recruter.updateImage', $jobpost->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <img src="{{ Storage::url($jobpost->gambar) }}" class="img-fluid" alt="">
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" class="form-control" name="gambar">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection