@extends('layouts.main-lp')

@section('title')Peta Kelurahan Umban Sari
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
@endpush

@section('container')

<section class="unique-cards section-py-space">
    <div class="title">
        <h2>Peta Kelurahan Umban Sari</h2>
    </div>
    <div class="container py-5">
        <div class="container-fluid blog-page">
            <div class="row">
                @component('components.warga.breadcrumb')
                @slot('breadcrumb_title')
                @endslot
                <li class="breadcrumb-item active">Peta Kelurahan Umban Sari</li>
                @endcomponent
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Luas Wilayah</h5>
                            Kelurahan Umban Sari terletak di Kecamatan Rumbai, Kota Pekanbaru. Posisi Kelurahan Umban Sari terletak di daerah yang sangat padat penduduk serta berbagai usaha lainnya.
                            <br><br>
                            Luas Wilayah Kelurahan Umban Sari seluruhnya adalah 8.068 km2.
                            <div class="container py-3">
                                <iframe width="520" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas"
                                src="https://maps.google.com/maps?width=520&amp;height=400&amp;hl=en&amp;q=Umban%20Sari%20Pekanbaru+(Umban%20Sari)&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                            </div>
                            Utara : Berbatasan dengan Kelurahan Rumbai Bukit dan Jalan Lintas Sumatra (Siak II)
                            Timur : Berbatasan dengan Kelurahan Lembah Damai dan Jalan Yos Sudarso
                            Barat : Berbatasan dengan Kelurahan Rumbai Bukit, Kelurahan Palas, dan Jalan Lintas Sumatra (Siak II)
                            Selatan : Berbatasan dengan Kelurahan Sri Meranti, Jalan Utama, dan Jalan Palas Mekar
                            <br><br>
                            Untuk mengunduh Peta Kelurahan Umban Sari terbaru, dapat melakukannya
                            <br><br>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Buka Gambar
                            </button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Gambar Peta Terbaru</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('assets/images/Peta-UmbanSari.jpg') }}" alt="Gambar Modal" class="img-fluid">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
