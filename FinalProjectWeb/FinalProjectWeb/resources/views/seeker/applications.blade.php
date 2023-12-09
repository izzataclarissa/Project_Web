@extends('seeker.main')

@section('content')
<style>
    .mb-4 {
        margin-bottom: 1.5rem;
    }

    .list-group-item {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 1rem;
        margin-bottom: 1rem;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
    }

    .list-group-item strong {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }

    .list-group-item p {
        margin-bottom: 0.25rem;
    }

    .btn-warning {
        color: #fff;
        background-color: #ffc107;
        border-color: #ffc107;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
    }

    .btn-warning:disabled {
        background-color: #ffc107;
        border-color: #ffc107;
        opacity: 0.65;
    }
</style>
    <div class="container mt-5">
        <h2 class="mb-4">My Job Applications</h2>

        @if (session('message'))
            <div class="alert alert-{{ session('alert-type') }} alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($applications->isEmpty())
            <p>You haven't applied for any jobs yet.</p>
        @else
            <ul class="list-group">
                @foreach ($applications as $application)
                    <li class="list-group-item">
                        <strong>{{ $application->jobpost->nama_perusahaan }}</strong>
                        <p>Position: {{ $application->jobpost->posisi }}</p>
                        <p>Position: {{ $application->jobpost->tipe }}</p>
                        <p>Status: {{ $application->status }}</p>
                        <a href="{{ route('seeker.profile.edit', $application->id) }}"
                            class="btn btn-warning btn-sm @if ($application->status !== 'menunggu') disabled @endif"
                            aria-disabled="{{ $application->status !== 'menunggu' ? 'true' : 'false' }}">
                            Edit Profile
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
