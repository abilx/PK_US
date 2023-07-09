<header class="landing-header">
    <div class="custom-container">
      <div class="row">
        <div class="col-12">
          <nav class="navbar navbar-light p-0" id="navbar-example2">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="{{ asset('assets/images/logo/logofix5.png') }}" alt="Logo">
            </a>
            <ul class="landing-menu nav nav-pills">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tentang Umban Sari
                        </a>
                    <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                        <a class="dropdown-item" href="{{ route('warga.AboutKelurahan') }}">Profil Kelurahan Umban Sari</a>
                        <a class="dropdown-item" href="{{ route('warga.MapKelurahan') }}">Peta Kelurahan Umban Sari</a>
                        <a class="dropdown-item" href="{{ route('warga.PerangkatKelurahan') }}">Perangkat Kelurahan Umban Sari</a>
                        <a class="dropdown-item" href="{{ route('warga.Visi-misiKelurahan') }}">Visi dan Misi Kelurahan Umban Sari</a>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('warga.berita') }}">Berita</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('warga.pengumuman') }}">Pengumman</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('warga.fasilitas') }}">Fasilitas</a></li>
            </ul>
            <div class="buy-block"><a class="btn-landing bg-danger" href="{{ route('login') }}">Login</a>
            <div class="toggle-menu"><i class="fa fa-bars"></i></div>
            </div>
          </nav>
        </div>
      </div>
    </div>
</header>
