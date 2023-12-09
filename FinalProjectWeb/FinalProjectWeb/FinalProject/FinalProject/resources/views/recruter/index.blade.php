@extends('recruter.main')
<style>
    thead tr th {
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    tbody tr td {
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .created-by-me {
        background-color: #0800ff;
        /* Ganti dengan warna yang diinginkan */
    }
</style>

@section('content')
    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Job Post</h3>
            <a href="{{ route('recruter.create') }}" class="btn btn-primary">Tambah Job</a>
        </div>
        <div class="card-body">
            @if (session('message'))
            <div class="alert alert-{{ session('alert-type') }} alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="align-middle">
                        <tr>
                            <th>No</th>
                            <th>Nama Perusahaan</th>
                            <th>Posisi</th>
                            <th>Tipe</th>
                            <th>gaji</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jobposts as $jobpost)
                            <tr class="{{ auth()->id() === $jobpost->user_id ? 'created-by-me' : '' }}">
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $jobpost->nama_perusahaan }}</td>
                                <td class="align-middle">{{ $jobpost->posisi }}</td>
                                <td class="align-middle">{{ $jobpost->tipe }}</td>
                                <td class="align-middle">Rp {{ number_format($jobpost->gaji, 0, ',', '.') }}</td>
                                <td class="align-middle">
                                    <a class="btn btn-sm btn-primary" href="{{ route('recruter.detail', ['jobpostId' => $jobpost->id]) }}">Detail</a>
                                    <a href="{{ route('recruter.edit', $jobpost) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form onclick="return confirm('Apakah anda yakin ingin menghapus data?');"
                                        class="d-inline" action="{{ route('recruter.destroy', $jobpost->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Data Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
