@extends('layouts.main-lp')

@section('title')Profil Kelurahan Umban Sari
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
@endpush

@section('container')

<section class="unique-cards section-py-space">
    <div class="title">
        <h2>Profil Kelurahan Umban Sari</h2>
    </div>
    <div class="container py-5">
        <div class="container-fluid blog-page">
            <div class="row">
                @component('components.warga.breadcrumb')
                @slot('breadcrumb_title')
                @endslot
                <li class="breadcrumb-item active">Profil Kelurahan Umban Sari</li>
                @endcomponent
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col">
                                    <h4>Profil Kelurahan Umban Sari</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('assets/images/tentang/halamanDepan2.png') }}" class="mx-auto d-block">
                            <p>
                                Kelurahan Umban Sari adalah salah satu kelurahan di Kecamatan Rumbai, Kota Pekanbaru, Provinsi Riau, Indonesia.
                                Kelurahan Umban Sari merupakan salah satu Kelurahan dari 7 Kelurahan yang berada di Kecamatan Rumbai, Kota Pekanbaru, Provinsi Riau, Indonesia.
                                <br><br>
                                Kelurahan Umban Sari berbatasan dengan Jalan Siak II (Kelurahan Rumbai Bukit) disebelah Utara, dengan Jalan Utama dan Jalan Palas Mekar (Kelurahan Sri Meranti) disebelah Selatan, dengan Jalan Yos Sudarso (Kelurahan Lembah Damai) disebelah Timur,
                                dengan Jalan Siak II (Kelurahan Rumbai Bukit dan Kelurahan Palas disebelah Barat.
                                <br><br>
                                Pada tahun 2021, Kelurahan Umban Sari ini mempunyai penduduk sebesar 19.478 Jiwa. Luasnya adalah 8,68km2.
                                <br><br>
                                Potensi Kelurahan Umban Sari antara lain Wirausahawan dengan banyaknya pelaku usaha, pertenakan seperti kambing, sapi dan ayam.
                                Kelurahan Umban Sari juga memiliki banyak kebun seperti durian, sawit, jagung, coklat, dan pinang, dimana berperan penting bagi mata pencaharian penduduk sekitar.
                                <br><br>
                                <h3>Fasilitas Kelurahan Umban Sari</h3>
                                <br>

                                <h5>Rumah Ibadah</h5>
                                <li>Masjid : 13 Bangunan</li>
                                <li>Mushala : 3 Bangunan</li>
                                <li>Vihara : 2 Bangunan</li>
                                <li>Gereja : 5 Bangunan</li>
                                <br>

                                <h5>Pendidikan</h5>
                                <li>Universitas : 2 Bangunan</li>
                                <li>Sekolah Menengah Atas : 1 Bangunan</li>
                                <li>Sekolah Menengah Kejuruan : 1 Bangunan</li>
                                <li>Sekolah Menengah Pertama : 1 Bangunan</li>
                                <li>Sekolah Dasar : 3 Bangunan</li>
                                <br>

                                <h5>Organisasi</h5>
                                <li>Lembaga Pemberdayaan Masyarakat</li>
                                <li>Pemberdayaan Kesejahteraan Keluarga</li>
                                <li>Karang Taruna</li>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
