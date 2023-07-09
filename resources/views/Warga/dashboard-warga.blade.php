@extends('layouts.main-warga')

@section('title')
Dashboard - Warga
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
                <div class="bg-primary b-r-4 card-body" onclick="test6()">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="calendar"></i></div>
                        <div class="media-body"><span class="m-0">Jumlah Lansia</span>
                            <h4 class="mb-0 counter">{{count($wargadatang)}}</h4><i class="icon-bg" data-feather="calendar"></i>
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
                        <div class="media-body"><span class="m-0">Jumlah UMKM</span>
                            <h4 class="mb-0 counter">{{ $no_kk }}</h4><i class="icon-bg" data-feather="users"></i>
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
                                <input class="form-check-input" type="radio" onchange="getSelectedValue()"
                                name="pertumbuhanRadio" id="pertumbuhanRadio1" value="first" checked>
                                <label class="form-check-label" for="pertumbuhanRadio1">
                                    Yatim
                                </label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" onchange="getSelectedValue()"
                                name="pertumbuhanRadio" id="pertumbuhanRadio2" value="second">
                                <label class="form-check-label" for="pertumbuhanRadio2">
                                    Putuh Sekolah
                                </label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" onchange="getSelectedValue()"
                                name="pertumbuhanRadio" id="pertumbuhanRadio3" value="third">
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
                                        <select class="form-control" onchange="updateChart(this)">
                                            <option value="first">5-10 Tahun</option>
                                            <option value="second">10-15 Tahun</option>
                                            <option value="third">15-20 Tahun</option>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('kondisiWargaChart').getContext('2d');

    var kondisiWarga = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Warga Mampu', 'Warga Miskin'],
            datasets: [{
                label: '%: ',
                data: [60, 30],
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

    var jumlahWarga = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['RT 01', 'RT 02', 'RT 03', 'RT 04', 'RT 05'],
            datasets: [{
                label: 'Jumlah Warga (2023)',
                data: [25, 26, 23, 22, 27],
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
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var ctx = document.getElementById('pengangguranChart').getContext('2d');

    var pengangguranChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['2023', '2022', '2021', '2020'],
            datasets: [{
                label: 'Jumlah Pengangguran',
                data: ([120, 90, 80, 60]),
                backgroundColor: [
                'rgba(205, 96, 16, 1)',
                'rgba(205, 96, 16, 1)',
                'rgba(205, 96, 16, 1)',
                'rgba(205, 96, 16, 1)'
                ],
                borderColor: [
                'rgba(96, 43, 6, 1)',
                'rgba(96, 43, 6, 1)',
                'rgba(96, 43, 6, 1)',
                'rgba(96, 43, 6, 1)'
                ],
                borderWidth: 1,
                barPercentage: 0.5,
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
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var ctx = document.getElementById('jenisKelaminChart').getContext('2d');

    var kondisiWarga = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                label: '%: ',
                data: [60, 40],
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

    const value = [{
        year: '2020',
        data: {
            first: 100,
            second: 200,
            third: 40
        },
    },
    {
        year: '2021',
        data: {
            first: 200,
            second: 100,
            third: 50
        },
    },
    {
        year: '2022',
        data: {
            first: 50,
            second: 100,
            third: 25
        },
    },
    {
        year: '2023',
        data: {
            first: 50,
            second: 100,
            third: 25
        },
    }
    ];

    const value2 = [{
        year: '2020',
        data: {
            first: 70,
            second: 145,
            third: 40
        },
    },
    {
        year: '2021',
        data: {
            first: 50,
            second: 100,
            third: 25
        },
    },
    {
        year: '2022',
        data: {
            first: 150,
            second: 100,
            third: 50

        },
    },
    {
        year: '2023',
        data: {
            first: 50,
            second: 100,
            third: 25
        },
    }
    ]

    var ctx = document.getElementById('pertumbuhanChart').getContext('2d');

    var pertumbuhanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            // labels: ['2023', '2022', '2021', '2020'],
            datasets: [{
                label: 'Yatim',
                data: value,
                backgroundColor: [
                'rgba(46, 151, 9, 1)',
                'rgba(46, 151, 9, 1)',
                'rgba(46, 151, 9, 1)',
                'rgba(46, 151, 9, 1)'
                ],
                borderWidth: 0,
                barPercentage: 0.5,
                categoryPercentage: 0.5,
                borderRadius: 10,
                parsing: {
                    xAxisKey: 'year',
                    yAxisKey: 'data.first'
                }
            },
            {
                label: 'Putus Sekolah',
                data: value2,
                backgroundColor: [
                'rgba(236, 239, 68, 1)',
                'rgba(236, 239, 68, 1)',
                'rgba(236, 239, 68, 1)',
                'rgba(236, 239, 68, 1)'
                ],
                borderWidth: 0,
                barPercentage: 0.5,
                categoryPercentage: 0.5,
                borderRadius: 10,
                parsing: {
                    xAxisKey: 'year',
                    yAxisKey: 'data.first'
                }
            }
            ]
        },
        options: {
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Number of Sales by Product Category'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    function updateChart(option) {
        pertumbuhanChart.data.datasets[0].parsing.yAxisKey = `data.${option.value}`;
        pertumbuhanChart.data.datasets[1].parsing.yAxisKey = `data.${option.value}`;
        pertumbuhanChart.update();
    }

    function getSelectedValue() {
        var selectedValue = document.querySelector('input[name="pertumbuhanRadio"]:checked').value;
        pertumbuhanChart.data.datasets[0].parsing.yAxisKey = `data.${selectedValue}`;
        pertumbuhanChart.data.datasets[1].parsing.yAxisKey = `data.${selectedValue}`;
        pertumbuhanChart.update();
    }
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
@endpush
@endsection
