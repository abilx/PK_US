@extends('layouts.main-pk')

@push('css')
<link rel="stylesheet" type="text/css" href={{ asset("assets/css/trix.css")}}>
<link rel="stylesheet" type="text/css" href={{ asset("assets/css/trix.css")}}>
    <script type="text/javascript" src={{ asset("assets/js/trix.js")}}></script>
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>
@endpush

@section('container')
@component('components.p-k.breadcrumb')
        @slot('breadcrumb_title')
        <h3>Berita</h3>
        @endslot
        <li class="breadcrumb-item"><a href="{{ route('pk.berita.index') }}">Berita</a></li>
        <li class="breadcrumb-item active">Edit Berita</li>
    @endcomponent
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Form edit Berita</h5>
                    </div>
                    <form class="form theme-form" method="POST" enctype="multipart/form-data" action="/PK/berita/{{ $berita->id }}">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" value="{{ $berita->id }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="judul">Judul
                                            Berita</label>
                                        <input class="form-control" name="judul" value="{{ old('judul',$berita->judul) }}" id="judul" type="text"
                                            placeholder="gotong royong bersama" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="kategori_berita">Kategori berita</label>
                                        <select class="form-select" name="kategori_berita" id="kategori_berita" required>
                                            @foreach ($kategori_kegiatan as $k)
                                                @if(old('kategori_berita',$berita->kategori_berita) == $k->id_kategori_kegiatan)
                                                    <option value="{{ $k->id_kategori_kegiatan }}" selected>{{ $k->kategori_kegiatan }}</option>
                                                @else
                                                    <option value="{{ $k->id_kategori_kegiatan }}">{{ $k->kategori_kegiatan }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="isi">Isi Berita</label>
                                        <input id="isi" type="hidden" name="isi" value="{{ old('isi',$berita->isi) }}">
                                        <trix-editor input="isi"></trix-editor>
                                    </div>
                                    @error('isi')
                                    <a class="text-danger">
                                        {{ $message }}
                                    </a>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 row">
                                        <label class="form-label">Gambar Berita</label>
                                        <input type="hidden" name="oldImage" value="{{ $berita->gambar }}">
                                        @if($berita->gambar)
                                        <img src="{{ asset('storage/'. $berita->gambar) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                                        @else
                                        <img class="img-preview img-fluid mb-3 col-sm-5">
                                        @endif
                                        <div class="col-sm-9">
                                            <input class="form-control" name="gambar" onchange="previewImage()" id="image" type="file" />
                                             <small class="text-muted">* Ukuran Maksimal File 4 Mb</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="form-label">Waktu terbit</label>
                                <div class="col-sm-9">
                                    <input class="form-control digits" id="example-datetime-local-input"
                                        type="datetime-local" name="created_at" value="{{ old('created_at',ConvertTanggal($berita->created_at)) }}" />
                                </div>
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
<script>
    function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection
