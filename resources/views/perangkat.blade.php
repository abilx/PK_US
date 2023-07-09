@extends('layouts.main-lp')

@section('title')Perangkat Kelurahan Umban Sari
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
@endpush

@section('container')

<section class="unique-cards section-py-space">
    <div class="title">
        <h2>Perangkat Kelurahan Umban Sari</h2>
    </div>
    <div class="container py-5">
        <div class="container-fluid blog-page">
            <div class="row">
                @component('components.warga.breadcrumb')
                @slot('breadcrumb_title')
                @endslot
                <li class="breadcrumb-item active">Perangkat Kelurahan Umban Sari</li>
                @endcomponent
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="{{ asset('assets/images/perangkat/US-02.png') }}" alt="Lurah Umban Sari" class="card-img-top">
                                        <div class="card-body text-center" style="background-color: #f5f5f5;">
                                            <h5 class="card-title">Lurah Umban Sari</h5>
                                            <p class="card-text">Hj. ASPARIDA, S.Sos. M.Si</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="{{ asset('assets/images/perangkat/Cendang-02.png') }}" alt="Sekretaris Lurah" class="card-img-top">
                                        <div class="card-body text-center" style="background-color: #f5f5f5;">
                                            <h5 class="card-title">Sekretaris Lurah</h5>
                                            <p class="card-text">CENDANG. S.Sos.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4 justify-content-center">
                                <div class="col-md-3">
                                    <div class="card">
                                        <img src="{{ asset('assets/images/perangkat/Devi-02.png') }}" alt="Kepala Seksi Kesejahteraan Sosial dan TRATIP" class="card-img-top">
                                        <div class="card-body text-center" style="background-color: #f5f5f5;">
                                            <h5 class="card-title">Kepala Seksi Kesejahteraan Sosial dan TRATIP</h5>
                                            <p class="card-text">MELIA DEFIRTA, S. Pd</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card">
                                        <img src="{{ asset('assets/images/perangkat/Yetri-02.png') }}" alt="Kepala Seksi Pemerintahan" class="card-img-top">
                                        <div class="card-body text-center" style="background-color: #f5f5f5;">
                                            <h5 class="card-title">Kepala Seksi Pemerintahan</h5>
                                            <p class="card-text">YETRI YUSNI, S.Kom</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card">
                                        <img src="{{ asset('assets/images/perangkat/Nina-02.png') }}" alt="Kepala Seksi Pembangunan dan Pemberdayaan Masyarakat" class="card-img-top">
                                        <div class="card-body text-center" style="background-color: #f5f5f5;">
                                            <h5 class="card-title">Kepala Seksi Pembangunan dan Pemberdayaan Masyarakat</h5>
                                            <p class="card-text">NINA NELMA YENTI, S.Pd</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4 justify-content-center">
                                <div class="col-md-3">
                                    <div class="card">
                                        <img src="{{ asset('assets/images/perangkat/Irfan-02.png') }}" alt="STAFF" class="card-img-top">
                                        <div class="card-body text-center" style="background-color: #f5f5f5;">
                                            <h5 class="card-title">STAFF</h5>
                                            <p class="card-text">MUHAMMAD IRFAN FADILAH</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card">
                                        <img src="{{ asset('assets/images/perangkat/Rini-02.png') }}" alt="STAFF" class="card-img-top">
                                        <div class="card-body text-center" style="background-color: #f5f5f5;">
                                            <h5 class="card-title">STAFF</h5>
                                            <p class="card-text">RINI HERLINA, S.K.M.</p>
                                        </div>
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
