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
        <li class="breadcrumb-item"><a href="{{ route('pk.index') }}">Petugas kelurahan</a></li>
        <li class="breadcrumb-item active">Tambah Petugas Kelurahan</li>
    @endcomponent
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Form tambah Petugas Kelurahan</h5>
                    </div>
                    <form class="form theme-form" name="f1" method="POST" action="{{ route('pk.store')}}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="username">Username</label>
                                        <input class="form-control @error('username') is-invalid @enderror" name="username" id="username" type="text" autofocus value="{{ old('username') }}"/>
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
                                        <input class="form-control @error('password') is-invalid @enderror" name="password" id="password" type="password" autofocus value="{{ old('password') }}"/>
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
                                        <select class="form-select" name="id_warga" id="id_warga" required>
                                            @foreach ($pk as $w)
                                                @if(old('id_warga') == $w->id_warga)
                                                    <option value="{{ $w->id_warga }}" selected>{{ $w->nama_lengkap }}</option>
                                                @else
                                                    <option value="{{ $w->id_warga }}">{{ $w->nama_lengkap }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                <label class="form-label">Tanggal Awal Jabatan</label>
                                    <input class="form-control digits" id="tgl_awal_jabatan_petugas_kelurahan"
                                        type="datetime-local" name="tgl_awal_jabatan_petugas_kelurahan" value="{{ old('tgl_awal_jabatan_petugas_kelurahan') }}" />
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
                                        type="datetime-local" name="tgl_akhir_jabatan_petugas_kelurahan" value="{{ old('tgl_akhir_jabatan_petugas_kelurahan') }}" />
                                </div>
                                @error('tgl_akhir_jabatan_petugas_kelurahan')
                                    <a class="text-danger">
                                        {{ $message }}
                                    </a>
                                    @enderror
                            </div>
                        </div>
                            <div class="mb-3 row" id="jenis_petugas">
                                <label class="col-sm-3 col-form-label">Jenis Petugas<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="form-group mt-2 m-checkbox-inline mb-0 custom-radio-ml">
                                        <div class="radio radio-primary">
                                            <input id="1w" type="radio" name="jenis_petugas"
                                                value="1" {{ old('jenis_petugas') == 1 ? 'checked' : '' }}>
                                            <label class="mb-0" for="1w">Lurah</label>
                                        </div>
                                        <div class="radio radio-primary">
                                            <input id="2w" type="radio" name="jenis_petugas"
                                                value="0" {{ old('jenis_petugas') == 0 ? 'checked' : '' }}>
                                            <label class="mb-0" for="2w">Petugas Kelurahan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" type="submit">Tambah</button>
                            <input class="btn btn-light" type="reset" value="Batal" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts-custom')
    @if ($hasUserWithRoleId2)
    <script>
        $(document).ready(function() {
            $('#jenis_petugas').hide();
        });
    </script>
    @endif
@endpush
