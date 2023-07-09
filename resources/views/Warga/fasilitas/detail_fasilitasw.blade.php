@extends('layouts.main-lp')

@section('title')Detail Fasilitas Kelurahan Umban Sari {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
@endpush

@section('container')

<section class="ecommerce-pages section-py-space light-bg">
    <div class="title">
        <h2>Detail Fasilitas Kelurahan Umban Sari</h2>
    </div>
    <div class="container py-5">
        <div class="container-fluid blog-page">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col">
                                    <h4>
                                        {{ $fasilitas->fasilitas_umum }}
                                    </h4>
                                </div>
                                <div class="single-blog-content-top txt-dark ">
                                    {!! $fasilitas->deskripsi_fasilitas !!}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body">
                                    <div class="blog-details">
                                        <ul class="blog-social">
                                            <li class="middle">Status :
                                                @if ($fasilitas->status_fasilitas == 1)
                                                <span id="status_aja" class="badge badge-success">Aktif</span>
                                                @else
                                                <span id="status_aja" class="badge badge-warning">Tidak Aktif</span>
                                                @endif
                                            </span>
                                        </li>
                                        <li class="middle">Kategori :<a
                                            href="/ProfilKelurahanUmbanSari/fasilitas?category={{ $fasilitas->kategori_fasilitas_umum }}">
                                            {{ $fasilitas->fasilitas_umumss->kategori_fasilitas }}</a></li>
                                        </ul>
                                        <hr />
                                        <div class="row">
                                            <div class="col-6">
                                                <h6 class="text-center">Map</h6>
                                                <div class="single-blog-content-top txt-dark">
                                                    @if ($fasilitas->koordinant_fasilitas != null)
                                                    <center class="mt-3">
                                                        {!! $fasilitas->koordinant_fasilitas !!}
                                                    </center>
                                                    @else
                                                    <center class="mt-3">
                                                        <h3>-- Map tidak ada --</h3>
                                                    </center>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="text-center">Gambar</h6>
                                                <div class="single-blog-content-top txt-dark">
                                                    <div class="mt-3">
                                                        <center>
                                                            <img class="img-fluid w-75 img-thumbnail "
                                                            src="{{ asset('storage/' . $fasilitas->foto_fasilitas) }}"
                                                            alt="Foto {{ $fasilitas->fasilitas_umum }} " />
                                                        </center>
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
            </div>
        </div>
        <div class="row">
            <div class="back-button">
                <a href="{{ route('warga.fasilitas') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
@endpush

@push('scripts-custom')
@endpush

@endsection
