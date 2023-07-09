@extends('layouts.main-lp')

@section('title')Detail Kegiatan Kelurahan Umban Sari {{ $title }}

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
                                        {{ $kegiatan->nama_kegiatan }}
                                    </h4>
                                </div>
                                <div class="single-blog-content-top txt-dark ">
                                    {!! $kegiatan->isi_kegiatan !!}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body">
                                    <div class="blog-details">
                                        <ul class="blog-social">
                                            <li class="middle">Publish : {{ $kegiatan->tanggal_publish == true ? $kegiatan->tanggal_publish : $kegiatan->created_at->diffForHumans() }}
                                            </li>
                                            <li class="middle">Status :
                                                @if ($kegiatan->status_kegiatan == 1) <span id="status_aja" class="badge badge-success">Aktif</span>
                                                @else <span id="status_aja" class="badge badge-warning">Tidak Aktif</span>
                                                @endif </span>
                                            </li>
                                        </ul>
                                        <hr />
                                        <h6>Waktu </h5>
                                        <div class="single-blog-content-top txt-dark mb-2">
                                            <ul class="blog-social">
                                                <li class="middle">
                                                    <strong>Tanggal Mulai Kegiatan : </strong> {{ tanggal_waktu_indo($kegiatan->tgl_mulai_kegiatan) }}
                                                </li>
                                                <li class="middle">
                                                    <strong>Tanggal Selesai Kegiatan : </strong> {{ tanggal_waktu_indo($kegiatan->tgl_selesai_kegiatan) }}
                                                </li>
                                            </ul>
                                        </div>
                                        @if ($kegiatan->foto_kegiatan != 'no-image.jpg')
                                        <hr />
                                        <h6>Lampiran Kegiatan</h5>
                                            <div class="single-blog-content-top txt-dark">
                                                <p class="text-center">
                                                    <img class="img-thumbnail w-50" src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}" alt="Foto {{ $kegiatan->nama_kegiatan }} " />
                                                </p>
                                            </div>
                                        @endif
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
                <a href="{{ route('warga.kegiatan') }}" class="btn btn-primary">Kembali</a>
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
