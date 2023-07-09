@extends('layouts.main-rw')

@section('title')
    Warga
    {{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
@endpush

@section('container')
    @component('components.lurah.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Daftar Warga</h3>
        @endslot
        {{-- <li class="breadcrumb-item">Pengaduan</li> --}}
        <li class="breadcrumb-item active">Daftar Warga</li>
    @endcomponent

    <div class="row">
        @foreach($warga as $rt)
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden border-0">
                <div class="media static-top-widget">
                    <div class="align-self-center text-center">
                        <div class="card-header">
                            <img src="{{ asset('assets/images/warga/Warga.png') }}" alt="Gambar" class="img-fluid"
                                width="300" height="200">
                        </div>
                        <div class="card-body">
                            <div class="body-top d-sm-flex align-items-center">
                                <h6><a href="/RW/list-rt/{{ $rt->id_rt}}">RT {{ $rt->no_rt}}</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        {{-- <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden border-0">
                <div class="media static-top-widget">
                    <div class="align-self-center text-center">
                        <div class="card-header">
                            <img src="{{ asset('assets/images/warga/Warga.png') }}" alt="Gambar" class="img-fluid"
                                width="300" height="200">
                        </div>
                        <div class="card-body">
                            <div class="body-top d-sm-flex align-items-center">
                                <h6><a href="/RW/list-warga/2" class="{{ prefixActive('rw.warga.warga') }}">RW2</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden border-0">
                <div class="media static-top-widget">
                    <div class="align-self-center text-center">
                        <div class="card-header">
                            <img src="{{ asset('assets/images/warga/Warga.png') }}" alt="Gambar" class="img-fluid"
                                width="300" height="200">
                        </div>
                        <div class="card-body">
                            <div class="body-top d-sm-flex align-items-center">
                                <h6><a href="/RW/list-warga/3" class="{{ prefixActive('rw.warga.warga') }}">RW3</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden border-0">
                <div class="media static-top-widget">
                    <div class="align-self-center text-center">
                        <div class="card-header">
                            <img src="{{ asset('assets/images/warga/Warga.png') }}" alt="Gambar" class="img-fluid"
                                width="300" height="200">
                        </div>
                        <div class="card-body">
                            <div class="body-top d-sm-flex align-items-center">
                                <h6><a href="/RW/list-warga/4" class="{{ prefixActive('rw.warga.warga') }}">RW4</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden border-0">
                <div class="media static-top-widget">
                    <div class="align-self-center text-center">
                        <div class="card-header">
                            <img src="{{ asset('assets/images/warga/Warga.png') }}" alt="Gambar" class="img-fluid"
                                width="300" height="200">
                        </div>
                        <div class="card-body">
                            <div class="body-top d-sm-flex align-items-center">
                                <h6><a href="/RW/list-warga/5" class="{{ prefixActive('rw.warga.warga') }}">RW5</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden border-0">
                <div class="media static-top-widget">
                    <div class="align-self-center text-center">
                        <div class="card-header">
                            <img src="{{ asset('assets/images/warga/Warga.png') }}" alt="Gambar" class="img-fluid"
                                width="300" height="200">
                        </div>
                        <div class="card-body">
                            <div class="body-top d-sm-flex align-items-center">
                                <h6><a href="/RW/list-warga/6" class="{{ prefixActive('rw.warga.warga') }}">RW6</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection


@push('scripts')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
@endpush

@push('scripts-custom')
    <script>
        $('#tabelwarga-rw').DataTable();
    </script>
@endpush
