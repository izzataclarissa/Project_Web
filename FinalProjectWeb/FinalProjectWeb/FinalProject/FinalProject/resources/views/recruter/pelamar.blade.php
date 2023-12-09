@extends('recruter.main')

@section('content')
<style>
    thead tr th,
    tbody tr td {
        text-align: center;
    }

    .btn-sm {
        margin: 2px; /* Tambahkan margin agar tombol tidak rapat-rapat */
    }
</style>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Daftar Pelamar</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="align-middle">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Kab / Kota</th>
                        <th>Provinsi</th>
                        <th>Email</th>
                        <th>Hp</th>
                        <th>CV</th>
                        <th>Nama Perusahaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($profiles as $profile)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $profile->nama }}</td>
                            <td>{{ $profile->tanggal_lahir }}</td>
                            <td>{{ $profile->jenis_kelamin }}</td>
                            <td>{{ $profile->alamat }}</td>
                            <td>{{ $profile->kabkota }}</td>
                            <td>{{ $profile->provinsi }}</td>
                            <td>{{ $profile->email }}</td>
                            <td>{{ $profile->hp }}</td>
                            <td>
                                <a href="{{ Storage::url($profile->gambarcv) }}" download>
                                    <button type="button" class="btn btn-primary btn-sm">Download CV</button>
                                </a>
                            </td>
                            <td>{{ $profile->jobpost->nama_perusahaan }}</td>
                            <td>
                                @if ($profile->status !== 'disetujui' && $profile->status !== 'ditolak')
                                    <form action="{{ route('recruter.profile.approve', $profile->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                    </form>
                                
                                    <form action="{{ route('recruter.profile.reject', $profile->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                    </form>
                                @else
                                    <button class="btn btn-success btn-sm" disabled>Setujui</button>
                                    <button class="btn btn-danger btn-sm" disabled>Tolak</button>
                                @endif
                                
                                <form onclick="return confirm('Apakah anda yakin ingin menghapus profile ini?');" class="d-inline" action="{{ route('profile.destroy', $profile->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center">Data Kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
