@extends('layouts.main-lp')

@section('title')Kelurahan Umban Sari
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owlcarousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prism.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/whether-icon.css') }}">
@endpush

@section('container')
<!-- Header-->
<header style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('assets/images/landing/background.jpg'); background-size: cover;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card text-center text-white bg-transparent border-0">
                    <h1 class="display-5 fw-bolder mb-4" style="text-transform: uppercase; line-height: 1.2;">Selamat Datang <br> Di Kelurahan Umban Sari</h1>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                        <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#features">Mulai</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<!-- Features section-->
<section class="demo-section section-py-space" id="Applications">
    <div class="title">
        <h2>Perangkat Kelurahan</h2>
    </div>
    <div class="custom-container">
        <div class="row demo-block">
            <div class="col-xl-3 col-lg-4 col-sm-6 wow fadeIn">
                <div class="demo-box">
                    <a href="{{ route('warga.PerangkatKelurahan') }}" target="_blank">
                        <div class="img-wrraper">
                            <img class="img-fluid" src="{{ asset('assets/images/perangkat/US.png') }}" alt="">
                        </div>
                        <div class="demo-detail">
                            <div class="demo-title">
                                <h5 class="card-title">Lurah Umban Sari</h5>
                                <p class="card-text">Hj. ASPARIDA, S.Sos. M.Si</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6 wow pulse">
                <div class="demo-box">
                    <a href="{{ route('warga.PerangkatKelurahan') }}" target="_blank">
                        <div class="img-wrraper">
                            <img class="img-fluid" src="{{ asset('assets/images/perangkat/Cendang.png') }}" alt="">
                        </div>
                        <div class="demo-detail">
                            <div class="demo-title">
                                <h5 class="card-title">Sekretaris Lurah</h5>
                                <p class="card-text">CENDANG. S.Sos.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6 wow fadeIn">
                <div class="demo-box">
                    <a href="{{ route('warga.PerangkatKelurahan') }}" target="_blank">
                        <div class="img-wrraper">
                            <img class="img-fluid" src="{{ asset('assets/images/perangkat/Yetri.png') }}" alt="">
                        </div>
                        <div class="demo-detail">
                            <div class="demo-title">
                                <<h5 class="card-title">Kepala Seksi Pemerintahan</h5>
                                <p class="card-text">YETRI YUSNI, S.Kom</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6 wow fadeIn">
                <div class="demo-box">
                    <a href="{{ route('warga.PerangkatKelurahan') }}" target="_blank">
                        <div class="img-wrraper">
                            <img class="img-fluid" src="{{ asset('assets/images/perangkat/Irfan.png') }}" alt="">
                        </div>
                        <div class="demo-detail">
                            <div class="demo-title">
                                <h5 class="card-title">STAFF</h5>
                            <p class="card-text">MUHAMMAD IRFAN FADILAH</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="demo-section section-py-space" id="Applications">
    <div class="title">
        <h2>Berita Kelurahan Umban Sari</h2>
    </div>
    <div class="custom-container">
        <div class="card">
            <div class="card-body">
                <div class="row demo-block">
                    @if ($berita->count())
                    {{-- <div class="row">
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
                    </div> --}}
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="core-feature section-py-space bg-white" id="features">
    <div class="title">
        <h2>Grafik Penduduk</h2>
    </div>
    <div class="container px-5 my-5">
        <div class="row">
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body" onclick="test2()">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                            <div class="media-body"><span class="m-0">Jumlah warga</span>
                                <h4 class="mb-0 counter">{{ count($warga)}}</h4><i class="icon-bg" data-feather="user-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body" onclick="test2()">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="calendar"></i></div>
                            <div class="media-body"><span class="m-0">Jumlah Lansia</span>
                                <h4 class="mb-0 counter">{{ count($lansia) }}</h4><i class="icon-bg" data-feather="calendar"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 col-xl-3 col-lg-5">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body" onclick="test6()">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="users"></i></div>
                            <div class="media-body"><span class="m-0">Warga Miskin</span>
                                <h4 class="mb-0 counter">{{count($kemiskinan)}}</h4><i class="icon-bg" data-feather="users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 col-xl-3 col-lg-5">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body" onclick="test6()">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="mail"></i></div>
                            <div class="media-body"><span class="m-0">K. Keluarga</span>
                                <h4 class="mb-0 counter">{{ $no_kk }}</h4><i class="icon-bg" data-feather="mail"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-5 col-xl-3 col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h5>Kondisi Warga</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-dashboard">
                            {{-- <div id="piechart"></div> --}}
                            <canvas height="300px" id="kondisiWargaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 col-xl-5 col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h5>Jumlah Warga</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-dashboard">
                            {{-- <div id="piechart"></div> --}}
                            <canvas height="300px" id="jumlahWargaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 col-xl-4 col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h5>Jumlah Pengagguran</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-dashboard">
                            {{-- <div id="piechart"></div> --}}
                            <canvas height="300px" id="pengangguranChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-5 col-xl-3 col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h5>Jenis Kelamin</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-dashboard">
                            <canvas height="300px" id="jenisKelaminChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 col-xl-4 col-lg-5">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Grafik pertumbuhan Anak</h5>
                    </div>
                    <div class="card-body pt-2">
                        <div class="row">
                            <div class="col-auto">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" onchange="getPertumbuhanAnak()"
                                    name="pertumbuhanRadio" id="pertumbuhanRadio1" value="yatim" checked>
                                    <label class="form-check-label" for="pertumbuhanRadio1">
                                        Yatim
                                    </label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" onchange="getPertumbuhanAnak()"
                                    name="pertumbuhanRadio" id="pertumbuhanRadio2" value="putus-sekolah">
                                    <label class="form-check-label" for="pertumbuhanRadio2">
                                        Putuh Sekolah
                                    </label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" onchange="getPertumbuhanAnak()"
                                    name="pertumbuhanRadio" id="pertumbuhanRadio3" value="beasiswa">
                                    <label class="form-check-label" for="pertumbuhanRadio3">
                                        Penerima Beasiswa
                                    </label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="row">
                                    <div class="col-auto">
                                        <label for="">Usia :</label>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-group">
                                            <select class="form-control" name="pertumbuhanSelect"
                                            onchange="getPertumbuhanAnak()">
                                            <option value="5-10">5-10 Tahun</option>
                                            <option value="10-15">10-15 Tahun</option>
                                            <option value="15-20">15-20 Tahun</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-dashboard">
                        <canvas height="300px" id="pertumbuhanChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-5 col-xl-5 col-lg-5">
            <div class="card o-hidden border-0">
                <div class="card">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h5>Kegiatan yang akan datang</h5>
                    </div>
                    <div class="card-body">
                        @if ($kegiatan->count())
                        <div class="user-status table-responsive mb-3">
                            <table class="table table-bordernone">
                                <thead>
                                    <tr>
                                        <th>Nama kegiatan</th>
                                        <th>Kategori kegiatan</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kegiatan as $p)
                                    <tr>
                                        <td>{{ $p->nama_kegiatan }}</td>
                                        <td>{{ $p->Kategori_kegiatans->kategori_kegiatan }}</td>
                                        <td>{{ tanggal_indo($p->tgl_mulai_kegiatan) }}</td>
                                        <td>
                                            @if ($p->status_kegiatan == 1)
                                            <span class="badge badge-primary">Aktif</span>
                                            @elseif($p->status_kegiatan == 0)
                                            <span class="badge badge-danger">Tidak aktif</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer pb-1 text-end">
                            <a href="{{ route('rw.kegiatan.index') }}">Lihat Selengkapnya...</a>
                        </div>
                        @else
                        Tidak ada kegiatan yang akan datang
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</section>

<!-- Testimonials section-->
{{-- <section class="py-5 border-bottom">
    <div class="container px-5 my-5 px-5">
        <div class="text-center mb-5">
            <h2 class="fw-bolder">Customer testimonials</h2>
            <p class="lead mb-0">Our customers love working with us</p>
        </div>
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-6">
                <!-- Testimonial 1-->
                <div class="card mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex">
                            <div class="flex-shrink-0"><i class="bi bi-chat-right-quote-fill text-primary fs-1"></i></div>
                            <div class="ms-4">
                                <p class="mb-1">Thank you for putting together such a great product. We loved working with you and the whole team, and we will be recommending you to others!</p>
                                <div class="small text-muted">- Client Name, Location</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 2-->
                <div class="card">
                    <div class="card-body p-4">
                        <div class="d-flex">
                            <div class="flex-shrink-0"><i class="bi bi-chat-right-quote-fill text-primary fs-1"></i></div>
                            <div class="ms-4">
                                <p class="mb-1">The whole team was a huge help with putting things together for our company and brand. We will be hiring them again in the near future for additional work!</p>
                                <div class="small text-muted">- Client Name, Location</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- Contact section-->
<section class="core-feature section-py-space bg-white">
    <div class="title">
        <h2>Pengaduan</h2>
    </div>
    <div class="container px-5 my-5 px-5">
        <div class="text-center mb-5">
            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-envelope"></i></div>
            <h2 class="fw-bolder">Tolong Isi Data</h2>
        </div>
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-6">
                @if (session()->has('success'))
                <div class="alert alert-success dark alert-dismissible fade show"
                role="alert">
                <strong>Sukses ! </strong> {{ session('success') }}.
                <button class="btn-close"
                type="button"
                data-bs-dismiss="alert"
                aria-label="Close"
                data-bs-original-title=""
                title=""></button>
            </div>
            @endif
            <!-- * * * * * * * * * * * * * * *-->
            <!-- * * SB Forms Contact Form * *-->
            <!-- * * * * * * * * * * * * * * *-->
            <!-- This form is pre-integrated with SB Forms.-->
            <!-- To make this form functional, sign up at-->
            <!-- https://startbootstrap.com/solution/contact-forms-->
            <!-- to get an API token!-->
            <form class="theme-form" enctype="multipart/form-data" method="POST" action="{{ route('warga.pengaduan.store_pengaduan') }}">
                @csrf
                <div class="col">
                    <div class="mb-3">
                        <label class="form-label"
                        for="nik">NIK Warga</label>
                        <input class="form-control" name="rt" id="rt" type="hidden" value="">
                        <input class="form-control @error('nik') is-invalid @enderror"
                        name="nik"
                        type="text"
                        id="nik"
                        name="nik"
                        value="{{ old('nik') }}"
                        placeholder="NIK Warga">
                        @error('nik')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label class="form-label"
                        for="">&nbsp;</label>
                        <button type="button" onclick="getDataWarga()"
                        id="cek_pelapor"
                        class="btn btn-secondary form-control text-white"><span class="fa fa-search"></span> Cek
                        Data</button>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label" for="judul_pengaduan">Judul Pengaduan</label>
                    <div class="col-sm-9">
                        <input class="form-control @error('judul_pengaduan') is-invalid @enderror" name="judul_pengaduan" id="judul_pengaduan" type="text" placeholder="Judul Pengaduan" value="" autocomplete="false" autofocus disabled>
                        @error('judul_pengaduan')
                        <div class="invalid-feedback">{{ $message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label" for="kategori_pengaduan">Kategori</label>
                    <div class="col-sm-9">
                        <select class="form-select digits" name="kategori_pengaduan" id="kategori_pengaduan" disabled>
                            @foreach ($pengaduan as $p)
                            <option value="{{ $p->id_kategori_pengaduan }}">{{ $p->nama_kategori_pengaduan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label" for="deskripsi_pengaduan">Deskripsi</label>
                    <div class="col-sm-9">
                        <textarea class="form-control @error('deskripsi_pengaduan') is-invalid @enderror" id="deskripsi_pengaduan" name="deskripsi_pengaduan" rows="3" disabled></textarea>
                        @error('deskripsi_pengaduan')
                        <div class="invalid-feedback">{{ $message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label" for="bukti_pengaduan">Bukti</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="file" id="bukti_pengaduan" name="bukti_pengaduan" disabled>
                        <small class="text-muted">* Ukuran Maksimal File 4 Mb</small>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-9">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <button class="btn btn-secondary" type="reset">Batal</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</section>

<!-- Container-fluid Ends-->
@push('scripts')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('kondisiWargaChart').getContext('2d');

    const kondisi_warga = @js($kondisi_warga);

    var kondisiWarga = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Warga Mampu', 'Warga Miskin'],
            datasets: [{
                label: '%: ',
                data: [kondisi_warga.warga_mampu, kondisi_warga.warga_miskin],
                backgroundColor: [
                'rgba(53, 71, 172, 1)',
                'rgba(217, 217, 217, 1)',
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Percentage of Internet Users by Device Type'
            },
            legend: {
                position: 'right'
            }
        }
    });

    var ctx = document.getElementById('jumlahWargaChart').getContext('2d');

    const jumlah_warga = @js($jumlah_warga);

    var jumlahWarga = new Chart(ctx, {
        type: 'line',
        data: {
            labels: jumlah_warga.list_rt,
            datasets: [{
                label: 'Jumlah Warga (2023)',
                data: jumlah_warga.data,
                borderColor: 'rgba(53, 71, 172, 1)',
                borderWidth: 2,
                pointBackgroundColor: 'rgba(217, 217, 217, 1)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Daily Temperature'
            }
        }
    });

    var ctx = document.getElementById('pengangguranChart').getContext('2d');

    const jumlah_pengangguran = @js($jumlah_pengangguran);

    var pengangguranChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: jumlah_pengangguran.year,
            datasets: [{
                label: 'Jumlah Pengangguran',
                data: (jumlah_pengangguran.data),
                backgroundColor: 'rgba(205, 96, 16, 1)',
                borderColor: 'rgba(96, 43, 6, 1)',
                borderWidth: 1,
                barPercentage: 0.1,
                categoryPercentage: 0.5,
                borderRadius: 10
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Number of Sales by Product Category'
            }
        }
    });

    var ctx = document.getElementById('jenisKelaminChart').getContext('2d');

    const jenis_kelamin = @js($jenis_kelamin);

    var kondisiWarga = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: jenis_kelamin.jenis,
            datasets: [{
                label: '%: ',
                data: jenis_kelamin.data,
                backgroundColor: [
                'rgba(21, 206, 247, 1)',
                'rgba(245, 23, 23, 1)',
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Percentage of Internet Users by Device Type'
            },
            legend: {
                position: 'right'
            }
        }
    });

    var pertumbuhanYear = [];
    var pertumbuhanData = [];

    function getPertumbuhanAnak(status, umur) {
        if (!status) {
            status = document.querySelector('input[name="pertumbuhanRadio"]:checked').value;
        }

        if (!umur) {
            umur = document.querySelector('select[name="pertumbuhanSelect"]').value;
        }

        fetch(`{{ route('chart.pertumbuhan.anak') }}?status=${status}&usia=${umur}`)
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(function(data) {
            reloadChartPertumbuhan(data);
        })
        .catch(function(error) {
            console.log(error);
        });
    }

    function reloadChartPertumbuhan(data) {
        var canvasId = 'pertumbuhanChart';

        var existingChart = Chart.getChart(canvasId);

        if (existingChart) {
            existingChart.destroy();
        }

        pertumbuhanYear = data.data.year;
        pertumbuhanData = data.data.data;

        var ctx = document.getElementById('pertumbuhanChart').getContext('2d');

        var pertumbuhanChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: pertumbuhanYear,
                datasets: [{
                    label: 'Laki-laki',
                    data: pertumbuhanData.laki,
                    backgroundColor: 'rgba(46, 151, 9, 1)',
                    borderWidth: 0,
                    barPercentage: 0.3,
                    categoryPercentage: 0.5,
                    borderRadius: 10,
                },
                {
                    label: 'Perempuan',
                    data: pertumbuhanData.perempuan,
                    backgroundColor: 'rgba(236, 239, 68, 1)',
                    borderWidth: 0,
                    barPercentage: 0.3,
                    categoryPercentage: 0.5,
                    borderRadius: 10,
                }
                ]
            },
            options: {
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: ''
                }
            }
        });

    }

    window.onload = function() {
        getPertumbuhanAnak();
    };
	
	@if(session('focusBottom'))
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				var element = document.getElementById('focus-bottom');
				if (element) {
					element.scrollIntoView({ behavior: 'smooth' });
				}
			});
		</script>
	@endif
</script>

<script src="{{ asset('assets/js/prism/prism.min.js') }}"></script>
<script src="{{ asset('assets/js/clipboard/clipboard.min.js') }}"></script>
<script src="{{ asset('assets/js/counter/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/js/counter/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/js/counter/counter-custom.js') }}"></script>
<script src="{{ asset('assets/js/custom-card/custom-card.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
<script src="{{ asset('assets/js/owlcarousel/owl.carousel.js') }}"></script>
<script src="{{ asset('assets/js/general-widget.js') }}"></script>
<script src="{{ asset('assets/js/height-equal.js') }}"></script>
<script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
<script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
<script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
<script src="{{ asset('assets/js/chart/apex-chart/chart-custom.js') }}"></script>


<script src="{{ asset('vendor/sweetalert/sweetalert.all.js')  }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
<script type="text/javascript" src={{ asset('assets/js/trix.js') }}></script>

<script>
    function getDataWarga() {
        //   var id = $('#nik').val();
        let id = $("input[name=nik]").val();
        const root_url = "{{ URL::to('/') }}";
        const url = `${root_url}/cek_warga`;
        // alert(url);
        // ajax
        $.ajax({
            type: "GET",
            url: url,
            data: {
                id: id
            },
            dataType: 'json',
            success: function(res) {
                console.log(res.data);
                if (res.data != null) {
                    let databaru = res.data;
                    $('#warga').val(databaru.id_warga);

                    // Aktifkan input dan isi nilai editor Trix
                    $("input[name=judul_pengaduan]").prop("disabled", false);
                    $("select[name=kategori_pengaduan]").prop("disabled", false);
                    $("textarea[name=deskripsi_pengaduan]").prop("disabled", false);
                    $("input[name=bukti_pengaduan]").prop("disabled", false);

                    $('#rt').val(databaru.rt);

                    Swal.fire({
                        title: 'Data Warga Ditemukan',
                        text: `NIK ${id} ditemukan dalam sistem`,
                        icon: 'success',
                        timer: 1500
                    });

                } else {
                    Swal.fire({
                        title: 'Data Warga Tidak Ditemukan',
                        text: `NIK ${id} tidak ditemukan dalam sistem`,
                        icon: 'warning',
                        timer: 1500
                    });
                }
            }
        });
    }

</script>

@endpush

@push('scripts-custom')
@endpush

@endsection