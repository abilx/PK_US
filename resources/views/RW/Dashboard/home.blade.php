@extends('layouts.main-rw')

@section('title')
    Dashboard - RW
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
    <!-- Container-fluid starts-->
    <div class="container-fluid general-widget">
        <div class="row">
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body" onclick="test()">
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

        {{-- <div class="row">
        <div class="col-xl-4 col-25 box-col-4 des-xl-25">
            <div class="card latest-update-sec">
                <div class="card-header">
                    <div class="header-top d-sm-flex align-items-center">
                        <h5>Jumlah warga </h5><p class="text-muted">(RT)</p>
                        <div class="center-content">
                        </div>
                    </div>
                    <p class="text-muted">Tahun : {{ now()->year }}</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive o-hidden" style="overflow-y: scroll; max-height:75px">
                        <table class="table table-bordernone">
                            <tbody>
                                @foreach ($gruprt as $gr)
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="media-body"><span class="m-0">RT {{ $gr->rt_rel->no_rt }}</span>
                                                <h4 class="mb-0 counter">{{ $gr->jumlah_warga}}</h4>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-25 box-col-4 des-xl-25">
            <div class="card latest-update-sec">
                <div class="card-header">
                    <div class="header-top d-sm-flex align-items-center">
                        <h5>Jumlah warga </h5><p class="text-muted">(Gender)</p>
                    </div>
                    <p class="text-muted">Tahun : {{ now()->year }}</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive o-hidden">
                        <table class="table table-bordernone">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="media-body"><span class="m-0">RT {{ $gt->rt_rel->no_rt }}</span>
                                            </div>
                                            <div class="media-body"><span class="m-0">Laki-Laki</span>
                                                <h4 class="mb-0 counter">{{ $lk}}</h4>
                                            </div>
                                            <div class="media-body"><span class="m-0">Perempuan</span>
                                                <h4 class="mb-0 counter">{{ $pr }}</h4>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-25 box-col-4 des-xl-25">
            <div class="card latest-update-sec">
                <div class="card-header">
                    <div class="header-top d-sm-flex align-items-center">
                        <h5>Jumlah Warga</h5><p class="text-muted">(Meninggal)</p>
                        <div class="center-content">
                        </div>
                    </div>
                    <p class="text-muted">Tahun : {{ now()->year }}</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive o-hidden">
                        <table class="table table-bordernone">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="media-body"><span class="m-0">Warga meninggal</span>
                                                <h4 class="mb-0 counter">{{ $meninggal}}</h4>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

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
                {{-- <tbody>
                    <tr>
                        <td>
                            <div class="media">
                                <div class="media-body"><span class="m-0">RT {{ $gt->rt_rel->no_rt }}</span>
                                </div>
                                <div class="media-body"><span class="m-0">Laki-Laki</span>
                                    <h4 class="mb-0 counter">{{ $lk }}</h4>
                                </div>
                                <div class="media-body"><span class="m-0">Perempuan</span>
                                    <h4 class="mb-0 counter">{{ $pr }}</h4>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody> --}}
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

    {{-- <div class="row">
    <div class="col-xl-4 col-25 box-col-4 des-xl-25">
        <div class="card latest-update-sec">
            <div class="card-header">
                <div class="header-top d-sm-flex align-items-center">
                    <h5>Jumlah warga </h5><p class="text-muted">(RT)</p>
                    <div class="center-content">
                    </div>
                </div>
                <p class="text-muted">Tahun : {{ now()->year }}</p>
            </div>
            <div class="card-body">
                <div class="table-responsive o-hidden" style="overflow-y: scroll; max-height:75px">
                    <table class="table table-bordernone">
                        <tbody>
                            @foreach ($gruprt as $gr)
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="media-body"><span class="m-0">RT {{ $gr->rt_rel->no_rt }}</span>
                                            <h4 class="mb-0 counter">{{ $gr->jumlah_warga}}</h4>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-25 box-col-4 des-xl-25">
        <div class="card latest-update-sec">
            <div class="card-header">
                <div class="header-top d-sm-flex align-items-center">
                    <h5>Jumlah warga </h5><p class="text-muted">(Gender)</p>
                </div>
                <p class="text-muted">Tahun : {{ now()->year }}</p>
            </div>
            <div class="card-body">
                <div class="table-responsive o-hidden">
                    <table class="table table-bordernone">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="media-body"><span class="m-0">RT {{ $gt->rt_rel->no_rt }}</span>
                                        </div>
                                        <div class="media-body"><span class="m-0">Laki-Laki</span>
                                            <h4 class="mb-0 counter">{{ $lk}}</h4>
                                        </div>
                                        <div class="media-body"><span class="m-0">Perempuan</span>
                                            <h4 class="mb-0 counter">{{ $pr }}</h4>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-25 box-col-4 des-xl-25">
        <div class="card latest-update-sec">
            <div class="card-header">
                <div class="header-top d-sm-flex align-items-center">
                    <h5>Jumlah Warga</h5><p class="text-muted">(Meninggal)</p>
                    <div class="center-content">
                    </div>
                </div>
                <p class="text-muted">Tahun : {{ now()->year }}</p>
            </div>
            <div class="card-body">
                <div class="table-responsive o-hidden">
                    <table class="table table-bordernone">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="media-body"><span class="m-0">Warga meninggal</span>
                                            <h4 class="mb-0 counter">{{ $meninggal}}</h4>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-6 xl-100 box-col-12">
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

<div class="col-xl-6 xl-100 box-col-12">
    <div class="card employee-status">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h5>Warga RW {{ auth()->user()->user_rel->no_rw }}</h5>
        </div>
        <div class="card-body">
            <div class="user-status table-responsive mb-3">
                <table class="table table-bordernone">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Nomor HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wargaw as $dw)
                        <tr>
                            <td class="bd-t-none u-s-tb">
                                <div class="align-middle image-sm-size"><img
                                    class="img-radius align-top m-r-15 rounded-circle"
                                    src="{{ asset('storage/' . $dw->foto_warga) }}" alt="">
                                    <div class="d-inline-block">
                                        <h6>{{ $dw->nama_lengkap }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $dw->alamat }}</td>
                            <td>
                                {{ $dw->no_hp_warga }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer pb-4 text-end">
            <a href="{{ route('rw.warga.index') }}">Lihat Selengkapnya...</a>
        </div>
    </div>
</div>

<div class="col-xl-6 xl-100 box-col-12">
    <div class="card employee-status">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h5>Pengajuan Surat</h5>
        </div>
        <div class="card-body">
            @if ($surat->count())
            <div class="user-status table-responsive mb-3">
                <table class="table table-bordernone">
                    <thead>
                        <tr>
                            <th scope="col">Nama pengaju</th>
                            <th scope="col">Tanggal pengaju</th>
                            <th scope="col">Status Pengajuan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($surat as $dw)
                        <tr>
                            <td class="bd-t-none u-s-tb">
                                <div class="align-middle image-sm-size"><img
                                    class="img-radius align-top m-r-15 rounded-circle"
                                    src="{{ asset('storage/' . $dw->wargas->foto_warga) }}" alt="">
                                    <div class="d-inline-block">
                                        <h6>{{ $dw->wargas->nama_lengkap }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>{{ tanggal_indo($dw->created_at) }}</td>
                            <td>
                                @if ($dw->status_surat == 0)
                                <span class="badge badge-warning">Diajukan</span>
                                @elseif($dw->status_surat == 1)
                                <span class="badge badge-secondary">Disetuji RT</span>
                                @elseif($dw->status_surat == 2)
                                <span class="badge badge-danger">Ditolak</span>
                                @elseif($dw->status_surat == 3)
                                <span class="badge badge-secondary">Disetuji RW</span>
                                @elseif($dw->status_surat == 4)
                                <span class="badge badge-success">Selesai</span>
                                @endif
                            </td>
                            <td class="aksi">
                                <a class="btn btn-success btn-sm p-2 m-1"
                                href="{{ route('rw.surat.detail.surat_keterangan', $dw->id_surat) }}"><span
                                class="fa fa-list"></span></a>
                                @if ($dw->status_surat != 0 && $dw->nomor_surat != null)
                                <a class="btn btn-secondary btn-sm p-2 m-1"
                                href="{{ route('rw.surat.print.surat_keterangan', $dw->id_surat) }}"><span
                                class="fa fa-print"></span></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer pb-1 text-end">
                <a href="{{ route('rw.surat.index') }}">Lihat Selengkapnya...</a>
            </div>
            @else
            Saat ini tidak ada pengajuan surat
            @endif
        </div>
    </div>
</div> --}}

    <script>
        function test() {
            window.location = '/RW/warga';
        }
    </script>
    <script>
        function test1() {
            window.location = '/RW/wargarw/tetaprw';
        }
    </script>
    <script>
        function test2() {
            window.location = '/RW/wargarw/pendatangrw';
        }
    </script>
    <script>
        function test3() {
            window.location = '/RW/wargarw/wargakk';
        }
    </script>
    <script>
        function test4() {
            window.location = '/RW/wargarw/wargam';
        }
    </script>
    <script>
        function test5() {
            window.location = '/RW/surat';
        }
    </script>
    <script>
        function test6() {
            window.location = '/RW/pengaduan';
        }
    </script>
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
  </script>

    <!-- Container-fluid Ends-->
    @push('scripts')
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
    @endpush
@endsection
