@extends('seeker.main')

@section('content')
<div class="row">
    <section class="py-5">
        @if (session('message'))
            <div class="alert alert-{{ session('alert-type') }} alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 justify-content-center">
                @foreach ($jobposts->sortByDesc('gaji')->take(3) as $jobpost)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ Storage::url($jobpost->gambar) }}"
                                alt="{{ $jobpost->nama_perusahaan }}" width="200" height="200" />
                            <!-- Product details-->
                            <div class="card-body card-body-custom pt-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $jobpost->nama_perusahaan }}</h5>
                                    <!-- Product price-->
                                    <div class="rent-price mb-3">
                                        <span class="text-primary">Rp
                                            {{ number_format($jobpost->gaji, 0, ',', '.') }}/</span>month
                                    </div>
                                    <ul class="list-unstyled list-style-group">
                                        <li class="border-bottom p-2 d-flex justify-content-between">
                                            <span>Posisi</span>
                                            <span style="font-weight: 600">{{ $jobpost->posisi }}</span>
                                        </li>
                                        <li class="border-bottom p-2 d-flex justify-content-between">
                                            <span>Tipe Pekerjaan</span>
                                            <span style="font-weight: 600">{{ $jobpost->tipe }}</span>
                                        </li>
                                        <li class="border-bottom p-2 d-flex justify-content-between">
                                            <span>Minimal Pendidikan</span>
                                            <span style="font-weight: 600">{{ $jobpost->pendidikan }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-footer border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-primary mt-auto btn-sm"
                                        href="{{ route('pelamar.create', ['jobpostId' => $jobpost->id]) }}">Aply</a>
                                        <a class="btn btn-sm btn-primary mt-auto" href="{{ route('seeker.detail', ['jobpostId' => $jobpost->id]) }}">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection