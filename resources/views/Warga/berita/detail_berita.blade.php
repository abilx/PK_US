@extends('layouts.main-lp')

@section('title')Detail Berita Kelurahan Umban Sari {{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
@endpush

@section('container')

<section class="demo-section section-py-space" id="Applications">
    <div class="title">
        <h2>Detail Berita Kelurahan Umban Sari</h2>
    </div>
    <div class="container py-5">
        <div class="container-fluid blog-page">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="blog-details">
                                    <ul class="blog-social">
                                        {{-- <li class="middle">Publish :
                                            {{ $berita->tanggal_publish == true ? $berita->tanggal_publish : $berita->created_at->diffForHumans() }}
                                        </li> --}}
                                        {{-- <li class="middle">Status :
                                            @if ($kegiatan->status_kegiatan == 1)
                                            <span id="status_aja" class="badge badge-success">Aktif</span>
                                            @else
                                            <span id="status_aja" class="badge badge-warning">Tidak Aktif</span>
                                            @endif
                                        </li> --}}
                                    </ul>
                                    <h4>
                                        {{ $berita->judul }}
                                    </h4> @if ($berita->gambar != 'no-image.jpg')
                                    {{-- <h6>Lampiran</h6> --}}
                                    <div class="single-blog-content-top txt-dark">
                                        <p class="text-center">
                                            <img class="img-thumbnail w-50" src="{{ asset('storage/' . $berita->gambar) }}" alt="Foto {{ $berita->judul }} " />
                                        </p>
                                    </div> @endif <div class="single-blog-content-top txt-dark"> {!! $berita->isi !!} </div>
                                    {{-- <h6>Waktu</h6> --}}
                                    {{-- <div class="single-blog-content-top txt-dark mb-2">
                                        <p>
                                            <strong>Tanggal Mulai Kegiatan :</strong>
                                            {{ tanggal_waktu_indo($kegiatan->tgl_mulai_kegiatan) }}
                                        </p>
                                        <p>
                                            <strong>Tanggal Selesai Kegiatan :</strong>
                                            {{ tanggal_waktu_indo($kegiatan->tgl_selesai_kegiatan) }}
                                        </p>
                                    </div> --}}
                                </div>
                            </div>
                            {{-- END TOMBOL DELETE --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="back-button">
                    <a href="{{ route('warga.berita') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- @endsection --}}
@push('scripts')
<script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
@endpush
@push('scripts-custom')
@endpush

@endsection
