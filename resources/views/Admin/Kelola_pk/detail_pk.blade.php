@extends('layouts.main-admin')

@section('container')
@component('components.admin.breadcrumb')
        @slot('breadcrumb_title')
        <h3>Petugas Kelurahan</h3>
        @endslot
        <li class="breadcrumb-item"><a href="{{ route('pk.index') }}">Petugas Kelurahan</a></li>
        <li class="breadcrumb-item active">Detail Petugas Kelurahan</li>
    @endcomponent
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body center">
                        <div class="container-fluid user-card">
                            <div class="row">
                                <div class="col-md-6 offset-md-3">
                                    <div class="card custom-card">

                                        <div class="card-profile"><img class="rounded-circle"
                                                src="{{asset('assets/images/avtar/1.png')}}" alt="" /></div>
                                        @foreach($identitas_pk as $ir)
                                        <div class="text-center profile-details">
                                            <a href="#">
                                                <h4>{{ $ir->identitas_pk->nama_lengkap }}</h4>
                                            </a>
                                        </div>
                                        <div class="card-footer row">
                                            <div class="col-4 col-sm-4">
                                                <h6>Status jabatan</h6>
                                                @if ($ir->status_pk == 1)
                                                        <span class="badge badge-success">Akitf</span>
                                                    @elseif($ir->status_pk == 0)
                                                            <span class="badge badge-warning">Tidak Aktif</span></td>
                                                @endif
                                            </div>
                                            <div class="col-4 col-sm-4">
                                                <h6>Awal menjabat</h6>
                                                <h6>{{ tanggal_indo($ir->tgl_awal_jabatan_petugas_kelurahan) }}</h6>
                                            </div>
                                            <div class="col-4 col-sm-4">
                                                <h6>Akhir menjabat</h6>
                                                <h6>{{ tanggal_indo($ir->tgl_akhir_jabatan_petugas_kelurahan) }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Zero Configuration  Ends-->
@endsection