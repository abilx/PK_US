@extends('layouts.main-lp')

@section('title')Kelurahan Umban Sari
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
@endpush

@section('container')

<section class="unique-cards section-py-space">
    <div class="title">
        <h2>Kontak Kami</h2>
    </div>
    <div class="container py-5">
        <div class="container-fluid blog-page">
            <div class="row">
                @component('components.warga.breadcrumb')
                @slot('breadcrumb_title')
                @endslot
                <li class="breadcrumb-item active">Kontak Kelurahan Umban Sari</li>
                @endcomponent
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Informasi Kontak</h5>
                            <p>Email :
                                <br>web.umbansari@gmail.com
                                <br>umbansarirumbai449@gmail.com
                            </p>
                            <p>Telepon : 0813-7498-2297 | Irfan – Staff</p>
                        </div>
                        <div class="card-body">
                            <h5>Lokasi</h5>
                            <div class="map-container">
                                <iframe width="520" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas"
                                src="https://maps.google.com/maps?width=520&amp;height=400&amp;hl=en&amp;q=Umban%20Sari%20Pekanbaru+(Umban%20Sari)&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
