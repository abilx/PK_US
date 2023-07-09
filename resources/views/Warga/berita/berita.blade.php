@extends('layouts.main-lp')

@section('title')Berita Kelurahan Umban Sari {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
@endpush

@section('container')
<section class="demo-section section-py-space" id="Applications">
    <div class="title">
        <h2>Berita Kelurahan Umban Sari</h2>
    </div>
    <div class="custom-container">
        <div class="card">
            <div class="card-body">
                <div class="row demo-block">
                    @if ($berita->count())
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pro-filter-sec">
                                <div class="product-search">
                                    <form action="berita">
                                        @if (request('category'))
                                        <input type="hidden" name="category" value="{{ request('category') }}">
                                        @endif
                                        <div class="form-group m-0">
                                            <input class="form-control" type="search" name="search" placeholder="Search.." data-original-title="" title="" value="{{ request('search') }}" />
                                            <i type="submit" class="fa fa-search"></i>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6 wow fadeIn">
                        <div class="demo-box">
                            <a href="social-app.html" target="_blank">
                                @foreach ($berita as $kk)
                                <div class="img-wrraper">
                                    @if ($kk->gambar != 'no-image.jpg')
                                    <a href="{{ route('warga.berita.show', $kk->id) }}">
                                        <img class="p-0" src="{{ asset('storage/' . $kk->gambar) }}" width="421" height="263" alt="" />
                                    </a>
                                    @else
                                    <a href="{{ route('warga.berita.show', $kk->id) }}">
                                        <img class="img-fluid top-radius-blog" src="{{ asset('assets/images/blog/blog-6.jpg') }}" alt="" />
                                    </a>
                                    @endif
                                </div>
                                <div class="demo-detail">
                                    <div class="demo-title">
                                        <div class="blog-date mt-3">
                                            {{ tanggal_indo($kk->created_at) }}
                                        </div>
                                        <a href="{{ route('warga.berita.show', $kk->id) }}">
                                            <h6 class="blog-bottom-details mt-2">{{ $kk->judul }}</h6>
                                        </a>
                                        <ul class="blog-social">
                                            <li>Kategori:
                                                <a href="/ProfilKelurahanUmbanSari/berita?category={{ $kk->kategori_berita }}">{{ $kk->beritas->kategori_kegiatan }}</a>
                                            </li>
                                        </ul>
                                        <hr />
                                        <h3>
                                            <a href="{{ route('warga.berita.show', $kk->id) }}" class="btn btn-sm {{ $kk->penanggung_jawab == 'RT' ? 'btn-primary' : 'btn-primary ' }} pull-right mb-3 mt-3" type="button">Baca Selengkapnya</a>
                                        </h3>
                                    </div>
                                </div>
                                @endforeach
                            </a>
                        </div>
                        @else
                        <div class="container-fluid blog-page">
                            <div class="feature-products">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pro-filter-sec">
                                            <div class="product-search">
                                                <form action="kegiatan">
                                                    <div class="form-group m-0">
                                                        <input class="form-control" type="search" name="search" placeholder="Search.." data-original-title="" title="" value="{{ request('search') }}" />
                                                        <i type="submit" class="fa fa-search"></i>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center">Kegiatan yang dicari tidak ada</p>
                        </div>
                        @endif
                        {{-- @endsection --}}
                        @push('scripts')
                        <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
                        @endpush
                        @push('scripts-custom')
                        @endpush
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
