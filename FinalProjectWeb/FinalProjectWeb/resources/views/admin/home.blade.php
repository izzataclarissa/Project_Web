@extends('admin.main')

@section('content')
<style>
    section.py-5 {
        padding-top: 5rem;
        padding-bottom: 5rem;
    }

    .container.px-4.px-lg-5 {
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }

    .row.gx-4.justify-content-center {
        gap: 1.5rem;
    }

    .col.mb-5 {
        margin-bottom: 3rem;
    }

    .card.h-100 {
        height: 100%;
        border: none;
        transition: transform 0.2s ease-in-out;
    }

    .card.h-100:hover {
        transform: scale(1.05);
    }

    .card-img-top {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .card-body.pt-4 {
        padding-top: 1rem;
    }

    .fw-bolder {
        font-weight: bolder;
    }

    .rent-price {
        font-size: 1.25rem;
    }

    .list-unstyled {
        list-style: none;
        padding: 0;
    }

    .list-style-group {
        margin: 0;
        padding: 0;
    }

    .border-bottom {
        border-bottom: 1px solid #dee2e6;
    }

    .p-2 {
        padding: 0.5rem;
    }

    .d-flex.justify-content-between {
        display: flex;
        justify-content: space-between;
    }

    .btn-primary {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        color: #fff;
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .mt-3 {
        margin-top: 1rem;
    }
</style>

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
                                                <a class="btn btn-sm btn-primary mt-3" href="{{ route('admin.detail', ['jobpostId' => $jobpost->id]) }}">Detail</a>
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
