@extends('layouts.main-lp')

@section('title')Pengumuman Kelurahan Umban Sari {{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
@endpush

@section('container')

<section class="unique-cards section-py-space">
    <div class="title">
        <h2>Pengumuman Kelurahan Umban Sari</h2>
    </div>
    <div class="container py-5">
        <div class="card">
            <div class="container px-5 my-5">
                @if ($pengumuman->count())
                <div class="container-fluid blog-page">
                    <div class="feature-products">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pro-filter-sec">
                                    <div class="product-search">
                                        <form action="pengumuman">
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
                    </div>
                    <div class="row">
                        <div class="col-xxl-6 set-col-12 box-col-12 xl-40">
                            <div class="card">
                                <div class="blog-box blog-shadow">
                                    @if ($pengumuman[0]->foto_pengumuman == 'no-image.jpg')
                                    <img class="img-fluid bg-img-cover" src="{{ asset('assets/images/blog/blog.jpg') }}" alt="" />
                                    @else
                                    <img class="img-fluid bg-img-cover" src="{{ asset('storage/' . $pengumuman[0]->foto_pengumuman) }}" alt="" />
                                    @endif
                                    <div class="blog-details">
                                        <p>{{ tanggal_indo($pengumuman[0]->tgl_terbit) }}</p>
                                        <h4>{{ $pengumuman[0]->judul_pengumuman }}</h4>
                                        <ul class="blog-social">
                                            <li>oleh: {{ $pengumuman[0]->penanggung_jawab }}</li>
                                            <li>Kategori: <a href="/pengumuman?category={{ $pengumuman[0]->kategori_pengumuman }}">{{ $pengumuman[0]->Kategori_pengumumans->nama_kategori_pengumuman }}</a>
                                            </li>
                                        </ul>
                                        <hr />
                                        <article class="mt-0 text-light">{!! Str::limit($pengumuman[0]->isi_pengumuman, 100) !!}</article>
                                        <div class="mt-3 pull-right">
                                            <a href="{{ route('warga.pengumuman.show', $pengumuman[0]->id_pengumuman) }}" class="btn btn-sm btn-secondary pull-right mt-5" type="button">Baca Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6 set-col-12 box-col-12 xl-60">
                            <div class="row">
                                @foreach ($pengumuman->skip(1)->take(2) as $k)
                                <div class="col-xl-12 col-md-6">
                                    <div class="card">
                                        <div class="blog-box blog-list row">
                                            <div class="col-xl-6 col-12">
                                                <div class="blog-wrraper">
                                                    @if ($k->foto_pengumuman == 'no-image.jpg')
                                                    <a href="{{ route('lurah.pengumuman.show', $k->id_pengumuman) }}">
                                                        <img class="img-fluid sm-100-wp p-0" src="{{ asset('assets/images/blog/blog-2.jpg') }}" alt="" />
                                                    </a>
                                                    @else
                                                    <a href="{{ route('lurah.pengumuman.show', $k->id_pengumuman) }}">
                                                        <img class="p-0" src="{{ asset('storage/' . $k->foto_pengumuman) }}" width="316" height="225" alt="" />
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-12">
                                                <div class="blog-details">
                                                    <div class="blog-date mt-3">{{ tanggal_indo($k->tgl_terbit) }}</div>
                                                    <a href="{{ route('lurah.pengumuman.show', $k->id_pengumuman) }}">
                                                        <h6>{{ $k->judul_pengumuman }}</h6>
                                                    </a>
                                                    <div class="blog-bottom-content">
                                                        <ul class="blog-social">
                                                            @if ($k->penanggung_jawab == 'RT')
                                                            <li>oleh: RT {{ $k->rts->no_rt }}</li>
                                                            @else
                                                            <li>oleh: RW {{ $k->rws->no_rw }}</li>
                                                            @endif
                                                            <li>Kategori:
                                                                <a href="/Lurah/pengumuman?category={{ $k->kategori_pengumuman }}">{{ $k->Kategori_pengumumans->nama_kategori_pengumuman }}</a>
                                                            </li>
                                                        </ul>
                                                        <hr />
                                                        <article class="mt-0 text-dark">{!! Str::limit($k->isi_pengumuman, 100) !!}</article>
                                                        <div class="pull-right  mt-3">
                                                            <a href="{{ route('lurah.pengumuman.show', $k->id_pengumuman) }}" class="btn btn-sm btn-secondary pull-right my-3" type="button">Baca Selengkapnya</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($pengumuman->skip(3) as $kk)
                        <div class="col-sm-6 col-xl-3 box-col-6 des-xl-50">
                            <div class="card">
                                <div class="blog-box blog-grid">
                                    <div class="blog-wrraper">
                                        @if ($kk->foto_pengumuman != 'no-image.jpg')
                                        <a href="{{ route('lurah.pengumuman.show', $kk->id_pengumuman) }}">
                                            <img class="p-0" src="{{ asset('storage/' . $kk->foto_pengumuman) }}" width="421" height="263" alt="" />
                                        </a>
                                        @else
                                        <a href="{{ route('lurah.pengumuman.show', $kk->id_pengumuman) }}">
                                            <img class="img-fluid top-radius-blog" src="{{ asset('assets/images/blog/blog-6.jpg') }}" alt="" />
                                        </a>
                                        @endif
                                    </div>
                                    <div class="blog-details-second">
                                        @if ($kk->penanggung_jawab == 'RT')
                                        <div class="blog-post-date">
                                            <span class="blg-month">RT {{ $kk->rts->no_rt }}</span>
                                        </div>
                                        @else
                                        <div class="blog-post-date">
                                            <span class="blg-date">RW {{ $kk->rws->no_rw }}</span>
                                        </div>
                                        @endif
                                        <div class="blog-date mt-3">{{ tanggal_indo($kk->tgl_terbit) }}</div>
                                        <a href="{{ route('lurah.pengumuman.show', $kk->id_pengumuman) }}">
                                            <h6 class="blog-bottom-details mt-2">{{ $kk->judul_pengumuman }}</h6>
                                        </a>
                                        <ul class="blog-social">
                                            @if ($kk->penanggung_jawab == 'RT')
                                            <li>oleh: RT {{ $k->rts->no_rt }}</li>
                                            @else
                                            <li>oleh: RW {{ $k->rws->no_rw }}</li>
                                            @endif
                                            <li>Kategori:
                                                <a href="/Lurah/pengumuman?category={{ $kk->kategori_pengumuman }}">{{ $kk->Kategori_pengumumans->nama_kategori_pengumuman }}</a>
                                            </li>
                                        </ul>
                                        <hr />
                                        <article class="mt-0 text-dark">
                                            <p>{!! Str::limit($kk->isi_pengumuman, 50) !!}</p>
                                        </article>
                                        <a href="{{ route('lurah.pengumuman.show', $kk->id_pengumuman) }}" class="btn btn-sm {{ $kk->penanggung_jawab == 'RT' ? 'btn-primary' : 'btn-secondary' }} pull-right mb-3 mt-3" type="button">Baca Selengkapnya</a>
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
                                        <form action="pengumuman">
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
                    <p>Pengumuman yang dicari tidak ada</p>
                </div>
                @endif
                <div class="d-flex justify-content-end mb-3">
                    {{ $pengumuman->links() }}
                </div>

                @push('scripts')
                <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
                @endpush

                @push('scripts-custom')
                @endpush
            </div>
        </div>
    </div>
    {{-- @endsection --}}
</section>

@endsection
