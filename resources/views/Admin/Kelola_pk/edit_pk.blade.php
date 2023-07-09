@extends('layouts.main-admin')

@push('css')
<link rel="stylesheet" type="text/css" href={{ asset("assets/css/trix.css")}}>
<link rel="stylesheet" type="text/css" href={{ asset("assets/css/trix.css")}}>
@endpush

@section('container')
@component('components.admin.breadcrumb')
        @slot('breadcrumb_title')
        <h3>Petugas Kelurahan</h3>
        @endslot
        <li class="breadcrumb-item"><a href="{{ route('pk.index') }}">Petugas Kelurahan</a></li>
        <li class="breadcrumb-item active">Edit Petugas Kelurahan</li>
    @endcomponent
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Form edit Petugas Kelurahan</h5>
                    </div>
                    <form class="form theme-form" method="POST" enctype="multipart/form-data" action="/pk/{{ $pk->id_pk }}">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="username">Username</label>
                                        <input class="form-control @error('username') is-invalid @enderror" name="username" id="username" type="text" autofocus value="{{ old('username',$user->username) }}"/>
                                        @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="password">Password</label>
                                        <input class="form-control @error('password') is-invalid @enderror" placeholder="****************" name="password" id="password" type="password" autofocus value=""/>
                                        @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="id_warga">Pilih Petugas</label>
                                        <select class="form-select" name="id_warga" id="id_warga" style="pointer-events: none;" onclick="return false;" onkeydown="return false;">
                                            <option value="{{ old('id_warga',$pk->id_warga) }}" selected>{{ $kelola_pk->nama_lengkap }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                <label class="form-label">Tanggal Awal Jabatan</label>
                                    <input class="form-control digits" id="tgl_awal_jabatan_petugas_kelurahan"
                                        type="datetime-local" name="tgl_awal_jabatan_petugas_kelurahan" value="{{ old('tgl_awal_jabatan_petugas_kelurahan',ConvertTanggal($pk->tgl_awal_jabatan_petugas_kelurahan)) }}" />
                                </div>
                                @error('tgl_awal_jabatan_petugas_kelurahan')
                                    <a class="text-danger">
                                        {{ $message }}
                                    </a>
                                    @enderror
                            </div>
                            </div>  
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                    <label class="form-label">Tanggal Akhir Jabatan</label>
                                    <input class="form-control digits" id="tgl_akhir_jabatan_petugas_kelurahan"
                                        type="datetime-local" name="tgl_akhir_jabatan_petugas_kelurahan" value="{{ old('tgl_akhir_jabatan_petugas_kelurahan',ConvertTanggal($pk->tgl_akhir_jabatan_petugas_kelurahan)) }}" />
                                </div>
                                @error('tgl_akhir_jabatan_petugas_kelurahan')
                                    <a class="text-danger">
                                        {{ $message }}
                                    </a>
                                    @enderror
                            </div>
                        </div>
                        <div class="card-footer text-end">
                             <button class="btn btn-primary" type="submit">Edit</button>
                            <button class="btn btn-secondary" type="reset">Reset</button>
                            <a class="btn btn-light" href="{{ url()->previous() }}">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
