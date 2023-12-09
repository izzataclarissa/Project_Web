@extends('admin.main')
<style>
    thead tr th,
    tbody tr td {
        text-align: center;
    }

    .created-by-me {
        background-color: #0800ff;
        color: white;
    }

    .table-responsive {
        margin-top: 20px;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-warning {
        background-color: #ffc107;
        color: #000;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background-color: #bd2130;
    }

    .alert {
        margin-top: 20px;
    }
</style>

@section('content')
    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Job Post</h3>
            <a href="{{ route('admin.create') }}" class="btn btn-primary">Tambah Job</a>
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
                                    <a href="{{ route('admin.edit', $jobpost) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form onclick="return confirm('Apakah anda yakin ingin menghapus data?');"
                                        class="d-inline" action="{{ route('admin.destroy', $jobpost->id) }}"
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
