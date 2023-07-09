@extends('layouts.main-rw')

@section('title')
Warga
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet"
type="text/css"
href="{{ asset('assets/css/datatables.css') }}">
<link rel="stylesheet"
type="text/css"
href="{{ asset('assets/css/custom.css') }}">
@endpush

@section('container')
@component('components.r-w.breadcrumb')
@slot('breadcrumb_title')
<h3> Daftar Warga</h3>
@endslot
<li class="breadcrumb-item">Warga</li>
<li class="breadcrumb-item active">Daftar Warga</li>
@endcomponent
<!-- Form Tambah Warga -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
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
        @if (session()->has('error'))
        <div class="alert alert-danger dark alert-dismissible fade show"
        role="alert">
        <strong>Gagal ! </strong> {{ session('error') }}.
        <button class="btn-close"
        type="button"
        data-bs-dismiss="alert"
        aria-label="Close"
        data-bs-original-title=""
        title=""></button>
    </div>
    @endif
</div>
</div>
    {{-- <div class="card">
        <div class="card-header pb-0">
            <div class="row">
                <div class="col-9">
                    <h5>Data Warga</h5>
                </div>
                <div class="col-3">
                    <div class="bookmark">
                        <a class="btn btn-primary btn-lg"
                        href="{{ route('rw.warga.create') }}"
                        data-bs-original-title=""
                        title=""> <span class="fa fa-plus-square"></span> Tambah Data</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row">
    <div class="col-sm-4 col-xl-4 col-lg-4">
        <div class="card o-hidden border-0">
        <div class="card" style="width: 18rem;">
            <img src="{{ asset('assets/images/warga/Warga.png') }}" class="card-img-top" alt="Gambar">
            <div class="align-self-center text-center">
                <div class="card-body">
                    <h5 class="card-title">RW 01</h5>
                    <a href="{{ route('rw.warga.index') }}" class="btn btn-primary">Go</a>
                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="col-sm-4 col-xl-4 col-lg-4">
        <div class="card o-hidden border-0">
        <div class="card" style="width: 18rem;">
            <img src="{{ asset('assets/images/warga/Warga.png') }}" class="card-img-top" alt="Gambar">
            <div class="align-self-center text-center">
                <div class="card-body">
                    <h5 class="card-title">RW 02</h5>
                    <a href="{{ route('rw.warga.index') }}" class="btn btn-primary">Go</a>
                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="col-sm-4 col-xl-4 col-lg-4">
        <div class="card o-hidden border-0">
        <div class="card" style="width: 18rem;">
            <img src="{{ asset('assets/images/warga/Warga.png') }}" class="card-img-top" alt="Gambar">
            <div class="align-self-center text-center">
                <div class="card-body">
                    <h5 class="card-title">RW 03</h5>
                    <a href="{{ route('rw.warga.index') }}" class="btn btn-primary">Go</a>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>

    <div class="row">
        <div class="col-sm-4 col-xl-4 col-lg-4">
            <div class="card o-hidden border-0">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('assets/images/warga/Warga.png') }}" class="card-img-top" alt="Gambar">
                <div class="align-self-center text-center">
                    <div class="card-body">
                        <h5 class="card-title">RW 04</h5>
                        <a href="{{ route('rw.warga.index') }}" class="btn btn-primary">Go</a>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <div class="col-sm-4 col-xl-4 col-lg-4">
            <div class="card o-hidden border-0">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('assets/images/warga/Warga.png') }}" class="card-img-top" alt="Gambar">
                <div class="align-self-center text-center">
                    <div class="card-body">
                        <h5 class="card-title">RW 05</h5>
                        <a href="{{ route('rw.warga.index') }}" class="btn btn-primary">Go</a>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <div class="col-sm-4 col-xl-4 col-lg-4">
            <div class="card o-hidden border-0">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('assets/images/warga/Warga.png') }}" class="card-img-top" alt="Gambar">
                <div class="align-self-center text-center">
                    <div class="card-body">
                        <h5 class="card-title">RW 06</h5>
                        <a href="{{ route('rw.warga.index') }}" class="btn btn-primary">Go</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    <!-- Form Pengaduan End -->
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
