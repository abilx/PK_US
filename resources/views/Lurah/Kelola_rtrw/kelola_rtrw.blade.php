@extends('layouts.main-lurah')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
@endpush

@section('container')
    @component('components.lurah.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Daftar RW</h3>
        @endslot
        {{-- <li class="breadcrumb-item">Pengaduan</li> --}}
        <li class="breadcrumb-item active">Daftar RW</li>
    @endcomponent

    <div class="row">
        @foreach($kelola_rw as $rw)
        <div class="col-sm-6 col-xl-4 col-lg-6">
            <div class="card o-hidden border-0">
                <div class="media static-top-widget">
                    <div class="align-self-center text-center">
                        <div class="card-header">
                            <img src="{{ asset('assets/images/warga/Gambar.png') }}" alt="Gambar" class="img-fluid"
                                width="300" height="200">
                        </div>
                        <div class="card-body">
                            <div class="body-top d-sm-flex align-items-center">
                                <h6><a href="{{ route('lurah.list.rw', $rw->id_rw)}}" class="{{ prefixActive('rw.warga.warga') }}">RW {{ $rw->no_rw}}</a></h6>
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
                            <img src="{{ asset('assets/images/warga/Gambar.png') }}" alt="Gambar" class="img-fluid"
                                width="300" height="200">
                        </div>
                        <div class="card-body">
                            <div class="body-top d-sm-flex align-items-center">
                                <h6><a href="/Lurah/list-rw/2" class="{{ prefixActive('rw.warga.warga') }}">RW2</a></h6>
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
                            <img src="{{ asset('assets/images/warga/Gambar.png') }}" alt="Gambar" class="img-fluid"
                                width="300" height="200">
                        </div>
                        <div class="card-body">
                            <div class="body-top d-sm-flex align-items-center">
                                <h6><a href="/Lurah/list-rw/3" class="{{ prefixActive('rw.warga.warga') }}">RW3</a></h6>
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
                            <img src="{{ asset('assets/images/warga/Gambar.png') }}" alt="Gambar" class="img-fluid"
                                width="300" height="200">
                        </div>
                        <div class="card-body">
                            <div class="body-top d-sm-flex align-items-center">
                                <h6><a href="/Lurah/list-rw/4" class="{{ prefixActive('rw.warga.warga') }}">RW4</a></h6>
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
                            <img src="{{ asset('assets/images/warga/Gambar.png') }}" alt="Gambar" class="img-fluid"
                                width="300" height="200">
                        </div>
                        <div class="card-body">
                            <div class="body-top d-sm-flex align-items-center">
                                <h6><a href="/Lurah/list-rw/5" class="{{ prefixActive('rw.warga.warga') }}">RW5</a></h6>
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
                            <img src="{{ asset('assets/images/warga/Gambar.png') }}" alt="Gambar" class="img-fluid"
                                width="300" height="200">
                        </div>
                        <div class="card-body">
                            <div class="body-top d-sm-flex align-items-center">
                                <h6><a href="/Lurah/list-rw/6" class="{{ prefixActive('rw.warga.warga') }}">RW6</a></h6>
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
        $('#dataTable').DataTable();
    </script>
@endpush
