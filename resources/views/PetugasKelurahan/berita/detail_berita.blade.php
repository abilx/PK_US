@extends('layouts.main-pk')

@section('title')
  Detail Berita
  {{ $title }}
@endsection

@push('css')
@endpush

@section('container')
  @component('components.p-k.breadcrumb')
    @slot('breadcrumb_title')
      <h3>
        Detail Berita</h3>
    @endslot
    <li class="breadcrumb-item"><a href="{{ route('pk.berita.index') }}">Berita</a></li>
    <li class="breadcrumb-item active">Detail Berita</li>
  @endcomponent

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="blog-single">
          <div class="blog-box blog-details">
            @if($berita->gambar == null)
            @else
            <div class="banner-wrraper"><img class="img-fluid w-100 bg-img-cover" src="{{asset('storage/'. $berita->gambar)}}" alt="blog-main" /></div>
            @endif
            <div class="card">
              <div class="card-body">
                <div class="blog-details">
                  <ul class="blog-social">
                    <li class="middle">Publish : {{ tanggal_waktu_indo($berita->created_at) }}</li>
                  </ul>
                  <h4>
                    {{ $berita->judul }}
                  </h4>
                  <div class="single-blog-content-top txt-dark">
                    {!! $berita->isi !!}.
                  </div>
                  @if($berita->gambar != null)
                  <h6>Lampiran</h5>
                    <div class="single-blog-content-top txt-dark">
                      <p class="text-center">
                        <img class="img-fluid w-75 " src="{{ asset('storage/' . $berita->gambar) }}"
                          alt="Foto {{$berita->gambar}} " />
                      </p>
                    </div>
                    @else
                    @endif
                </div>
              </div>
              <div class="card-footer text-end">
                {{-- TOMBOL AKTIF NON AKTIF --}}
                {{-- <button class='btn @php echo $berita->status_pengumuman == 0 ? 'btn-success' : 'btn-warning' @endphp
                  btn-lg' id="ubah_status" data-id="{{ $pengumuman->id_pengumuman }}"
                  data-status="{{ $pengumuman->status_pengumuman == 1 ? 0:1 }}"
                  href="{{ route('pk.pengumuman.edit', $pengumuman->id_pengumuman) }}"><span class="fa fa-edit"></span>
                  {{ $pengumuman->status_pengumuman == 0 ? 'Aktif' : 'Non-Aktif' }}</button> --}}
                {{-- END TOMBOL AKTIF NON AKTIF --}}

                {{-- TOMBOL EDIT --}}
                <a class="btn btn-secondary btn-lg"
                  href="{{ route('pk.berita.edit', $berita->id) }}"><span
                    class="fa fa-edit"></span>Edit</a>
                {{-- END TOMBOL EDIT --}}

                {{-- TOMBOL DELETE --}}
                <form method="POST" action="{{ route('pk.berita.destroy', $berita->id) }}"
                  class="d-inline">
                  @csrf
                  @method('DELETE')
                  {{-- <input name="_method" type="hidden" value="DELETE"> --}}
                  <button type="submit" class="btn btn-danger btn-lg border-0 sweet"><span class="fa fa-trash"></span>
                    Hapus</button>
                </form>
              </div>
              {{-- END TOMBOL DELETE --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- </div>
  </div> --}}
@endsection

@push('scripts-custom')
  <script>

  </script>
@endpush
