@extends('layouts.main-lp')

@section('title')Fasilitas Umum Kelurahan Umban Sari {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
@endpush

@section('container')

<section class="demo-section section-py-space" id="Applications">
    <div class="title">
        <h2>Fasilitas Umum Kelurahan Umban Sari</h2>
    </div>
    <div class="container py-5">
        <div class="container-fluid blog-page">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            @if($fasilitas->count() )
                            <div class="container-fluid blog-page">
                                <div class="feature-products">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="pro-filter-sec">
                                                <div class="product-search">
                                                    <form action="fasilitas">
                                                        <div class="form-group m-0"><input class="form-control" type="search" name="search" placeholder="Search.." data-original-title="" title="" value="{{ request('search') }}" /><i type="submit" class="fa fa-search"></i></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @foreach ($fasilitas as $kk)
                                    <div class="col-sm-6 col-xl-3 box-col-6 des-xl-50">
                                        <div class="card">
                                            <div class="blog-box blog-grid">
                                                <div class="blog-wrraper">
                                                    <a href="{{ route('warga.fasilitas.show',$kk->id_fasilitas_umum) }}"><img class="p-0" src="{{ asset('storage/' . $kk->foto_fasilitas) }}" width="421" height="263" alt="" /></a>
                                                </div>
                                                <div class="blog-details-second">
                                                    {{-- <div class="blog-post-date"><span class="blg-month">RT {{$kk->rts->no_rt}}</span><span class="blg-date">RW  {{$kk->rts->rw_rel->no_rw }}</span></div> --}}
                                                    <a href="{{ route('warga.fasilitas.show',$kk->id_fasilitas_umum) }}">
                                                        <h6 class="blog-bottom-details">{{ Str::limit($kk->fasilitas_umum, 20) }}</h6></a>
                                                        <article class="mt-0 text-dark mb-3">{!! Str::limit($kk->deskripsi_fasilitas, 40) !!}</article>
                                                        {{-- <p>Alamat : {{  Str::limit($kk->alamat_fasilitas,20) }}</p> --}}
                                                        <div class="detail-footer">
                                                            <ul class="sociyal-list">
                                                                <li><i class="fa fa-building-o"></i><a href="/fasilitas?category={{ $kk->kategori_fasilitas_umum }}">{{ $kk->fasilitas_umumss->kategori_fasilitas }}</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @else
                            <div class="container-fluid blog-page">
                                <div class="feature-products">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="pro-filter-sec">
                                                <div class="product-search">
                                                    <form action="fasilitasrt">
                                                        <div class="form-group m-0"><input class="form-control" type="search" name="search" placeholder="Search.." data-original-title="" title="" value="{{ request('search') }}" /><i type="submit" class="fa fa-search"></i></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p>Fasilitas yang dicari tidak ada</p>
                            </div>
                            @endif
                            <div class="d-flex justify-content-end mb-3">
                                {{ $fasilitas->links() }}
                            </div>
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
    </div>
</section>

@endsection
