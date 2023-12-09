@extends('recruter.main')

@section('content')
    <div class="row">
        <section class="py-5">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 justify-content-center">
                    @foreach ($jobposts as $jobpost)
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
                                            <li>
                                                <a class="btn btn-sm btn-primary mt-3" href="{{ route('recruter.detail', ['jobpostId' => $jobpost->id]) }}">Detail</a>
                                            </li>
                                        </ul>
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
