@extends('layouts.main-lp')

@section('title')Visi Misi Kelurahan Umban Sari {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
@endpush

@section('container')

<section class="unique-cards section-py-space">
    <div class="title">
        <h2>Visi Misi Kelurahan Umban Sari</h2>
    </div>
    <div class="container py-5">
        <div class="container-fluid blog-page">
            <div class="row justify-content-center">
                @component('components.warga.breadcrumb')
                @slot('breadcrumb_title')
                @endslot
                <li class="breadcrumb-item active">Visi Misi Kelurahan Umban Sari</li>
                @endcomponent
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row justify-content-center">
                        <div class="col-xl-3 col-lg-4 col-sm-6 wow fadeIn">
                            <div class="demo-box">
                                <div class="card">
                                    <div class="img-wrraper">
                                        <img class="img-fluid" src="{{ asset('assets/images/perangkat/US-02.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="demo-detail">
                                    <div class="demo-title">
                                        <h5 class="card-title">Lurah Umban Sari</h5>
                                        <p class="card-text">Hj. ASPARIDA, S.Sos. M.Si</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card bg-primary">
                                <div class="card-body">
                                    <h5 class="card-title text-white"><center>"Terwujudnya Pelayanan Prima Dan Smart".</center></h5>
                                </div>
                            </div>
                        </div>
                        <div class="u-steps">
                            <div class="u-step">
                                <span class="u-step-number">1</span>
                                <div class="u-step-desc">
                                    <span class="u-step-title">Terwujudnya Kinerja Aparatur Kelurahan Umban Sari Yang Transparan, Efektif, Efisien, Dan Akuntabel.</span>
                                </div>
                            </div>
                            <div class="u-step">
                                <span class="u-step-number">2</span>
                                <div class="u-step-desc">
                                    <span class="u-step-title">Meningkatkan Sumber Daya Masyarakat Yang Bertaqwa, Mandiri, Tangguh Dan Berdaya Saing Tinggi.</span>
                                </div>
                            </div>
                            <div class="u-step">
                                <span class="u-step-number">3</span>
                                <div class="u-step-desc">
                                    <span class="u-step-title">Terwujudnya Kelembagaan Masyarakat Yang Sinergis Dan Memiliki Kapabilitas.</span>
                                </div>
                            </div>
                            <div class="u-step">
                                <span class="u-step-number">4</span>
                                <div class="u-step-desc">
                                    <span class="u-step-title">Terwujudnya Lingkungan Kelurahan Umban Sari Yang Bersih Dan Ramah Lingkungan.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@endsection
