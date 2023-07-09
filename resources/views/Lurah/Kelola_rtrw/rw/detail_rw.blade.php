@extends('layouts.main-lurah')

@section('container')
@component('components.lurah.breadcrumb')
        @slot('breadcrumb_title')
        <h3>RW</h3>
        @endslot
        <li class="breadcrumb-item"><a href="{{ route('lurah.rw.index') }}">RW</a></li>
        <li class="breadcrumb-item active">Detail RW</li>
    @endcomponent
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-9">
                                @foreach($identitas_rw as $kr)
                                {{-- @if($kr->no_rw < 10)
                                            <h5>RW 0{{ $kr->no_rw }}</h5>
                                            @else --}}
                                            <h5>RW {{ $kr->no_rw }}</h5>
                                            {{-- @endif --}}
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-body center">
                        <div class="container-fluid user-card">
                            <div class="row">
                                <div class="col-md-6 offset-md-3">
                                    <div class="card custom-card">
                                        <div class="card-profile">
                                            @if ($kr->identitas_rw->foto_warga != NULL)
                                                <img class="rounded-circle"
                                                    src="{{ asset('storage/' . $kr->identitas_rw->foto_warga) }}" alt="" /></div>
                                            @else 
                                                <img class="rounded-circle"
                                                src="{{ asset('assets/images/avtar/1.png') }}" alt="" /></div>
                                            @endif
                                            <ul class="card-social">
                                                <li>
                                                    <a target="_blank" href="https://wa.me/{{ FormatHP($kr->identitas_rw->no_hp_warga) }}"><i
                                                            class="fa fa-phone"></i></i></a>
                                                </li>
                                                <li>
                                                    <input type="hidden" id="place-input" value="{{ $kr->identitas_rw->alamat }}"> 
                                                    <a href="#" onclick="searchAndRedirect()"><i class="fa fa-institution"></i></a>
                                                </li>
                                            </ul>
                                        @foreach($identitas_rw as $ir)
                                        
                                        <div class="text-center profile-details">
                                            <a href="#">
                                                <h4>{{ $ir->identitas_rw->nama_lengkap }}</h4>
                                            </a>
                                            {{-- @if($ir->no_rw < 10)
                                            <h6>RW 0{{ $ir->no_rw }}</h6>
                                            @else --}}
                                            <h6>RW {{ $ir->no_rw }}</h6>
                                            {{-- @endif --}}
                                        
                                        <div class="text-center profile-details">
                                            <h6 class="f-w-400">{{ date('Y', strtotime($ir->tgl_awal_jabatan_rw)) }} -
                                                {{ date('Y', strtotime($ir->tgl_akhir_jabatan_rw)) }}</h6>
                                        </div>
                                    </div>
                                        <div class="card-footer row">
                                            
                                            <div class="col-12 col-sm-12 mt-2">
                                                <h3 class="txt-primary">Kontak</h3>
                                                <h6>{{ $ir->identitas_rw->no_hp_warga }}</h6>
                                            </div>
                                            <div class="col-12 col-sm-12 mt-2">
                                                <h3 class="txt-primary">Alamat</h3>
                                                <h6>{{ $ir->identitas_rw->alamat }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row">
                                @foreach($identitas_rt as $it)
                                <div class="col-md-6 col-lg-6 col-xl-4 box-col-6">
                                    <div class="card custom-card">

                                        <div class="card-profile">
                                            @if ($it->identitas_rt->foto_warga != NULL)
                                                <img class="rounded-circle"
                                                    src="{{ asset('storage/' . $it->identitas_rt->foto_warga) }}" alt="" /></div>
                                            @else 
                                                <img class="rounded-circle"
                                                src="{{ asset('assets/images/avtar/1.png') }}" alt="" /></div>
                                            @endif
                                            <ul class="card-social">
                                                <li>
                                                    <a target="_blank" href="https://wa.me/{{ FormatHP($it->identitas_rt->no_hp_warga) }}"><i
                                                            class="fa fa-phone"></i></i></a>
                                                </li>
                                                <li>
                                                    <input type="hidden" id="place-input2" value="{{ $it->identitas_rt->alamat }}"> 
                                                    <a href="#" onclick="searchAndRedirect2()"><i class="fa fa-institution"></i></a>
                                                </li>
                                            </ul>
                                        <div class="text-center profile-details">
                                            <a href="#">
                                                <h4>{{ $it->identitas_rt->nama_lengkap }}</h4>
                                            </a>
                                            {{-- @if($it->no_rt < 10)
                                            <h6>RT 0{{ $it->no_rt }}</h6>
                                            @else --}}
                                            <h6>RT {{ $it->no_rt }}</h6>
                                            {{-- @endif --}}
                                        </div>
                                        <div class="text-center profile-details">
                                            <h6 class="f-w-400">{{ date('Y', strtotime($it->tgl_awal_jabatan_rt)) }} -
                                                {{ date('Y', strtotime($it->tgl_akhir_jabatan_rt)) }}</h6>
                                        </div>
                                        <div class="card-footer row">
                                            <div class="col-12 col-sm-12 mt-2">
                                                <h3 class="txt-primary">Kontak</h3>
                                                <h6>{{ $it->identitas_rt->no_hp_warga }}</h6>
                                            </div>
                                            <div class="col-12 col-sm-12 mt-2">
                                                <h3 class="txt-primary">Alamat</h3>
                                                <h6>{{ $it->identitas_rt->alamat }}</h6>
                                            </div>
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
<!-- Zero Configuration  Ends-->
@endsection

<script>
    function searchAndRedirect() {
        place = document.getElementById('place-input').value; // Mendapatkan nilai dari input teks
        

        // Membangun URL untuk Google Maps dengan tempat yang ditentukan
        var url = 'https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(place);

        // Melakukan redirect ke URL Google Maps
        window.location.href = url;
    }
    function searchAndRedirect2() {
        place = document.getElementById('place-input2').value; // Mendapatkan nilai dari input teks
        

        // Membangun URL untuk Google Maps dengan tempat yang ditentukan
        var url = 'https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(place);

        // Melakukan redirect ke URL Google Maps
        window.location.href = url;
    }
</script>