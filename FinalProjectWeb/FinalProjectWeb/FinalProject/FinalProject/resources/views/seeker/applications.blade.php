@extends('seeker.main')

@section('content')
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
