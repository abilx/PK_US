@extends('layouts.main-lp')

@section('title')Detail Pengumuman Kelurahan Umban Sari {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
@endpush

@section('container')

<section class="unique-cards section-py-space">
    <div class="title">
        <h2>Detail Pengumuman Kelurahan Umban Sari</h2>
    </div>
    <div class="custom-container">
        <div class="row demo-block demo-imgs">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col">
                                    <h4>
                                        {{ $pengumuman->judul_pengumuman }}
                                    </h4>
                                </div>
                                <div class="single-blog-content-top txt-dark ">
                                    {!! $pengumuman->isi_pengumuman !!}
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="blog-single">
                                    <div class="blog-box blog-details">
                                        @if ($pengumuman->foto_pengumuman == null)
                                        @else {{-- <div class ="banner-wrraper">
                                            <img class="img-fluid w-100 bg-img-cover" src="{{asset('storage/'. $pengumuman->foto_pengumuman)}}" alt="blog-main" /> </div> --}}
                                            @endif
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="blog-details">
                                                        <ul class="blog-social">
                                                            <li class="middle">Publish : {{ tanggal_waktu_indo($pengumuman->tgl_terbit) }}</li>
                                                            <li class="middle">Status :
                                                                @if ($pengumuman->status_pengumuman == 1) <span id="status_aja" class="badge badge-success">Aktif</span>
                                                                @else
                                                                <span id="status_aja" class="badge badge-warning">Tidak Aktif</span>
                                                                @endif
                                                            </span>
                                                        </li>
                                                        <li class="middle">Kategori : <a href="/ProfilKelurahanUmbanSari/pengumuman?category={{ $pengumuman->kategori_pengumuman }}">
                                                            {{ $pengumuman->Kategori_pengumumans->nama_kategori_pengumuman }}</a>
                                                        </li>
                                                    </ul>
                                                    @if ($pengumuman->foto_pengumuman != null)
                                                    <h6>Lampiran
                                                    </h5>
                                                    <div class="single-blog-content-top txt-dark">
                                                        <p class="text-center">
                                                            <img class="img-fluid w-75 " src="{{ asset('storage/' . $pengumuman->foto_pengumuman) }}" alt="Foto {{ $pengumuman->judul_pengumuman }} " />
                                                        </p>
                                                    </div>
                                                    @else
                                                    @endif
                                                </div>
                                            </div>
                                        {{-- END TOMBOL DELETE --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        @push('scripts')
                            <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
                        @endpush

                        @push('scripts-custom')
                        @endpush
                    </div>
                 </div>
            </div>
        </div>
        <div class="row">
            <div class="back-button">
                <a href="{{ route('warga.pengumuman') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</section>

@endsection
