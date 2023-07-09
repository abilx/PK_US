<header class="main-nav">
    <div class="sidebar-user text-center">
        {{-- <a class="setting-primary" href="{{ route('lurah.profile.show', auth()->user()->_warga->id_warga) }}">
            <i data-feather="settings"></i>
        </a>
        @if (auth()->user()->identitas_lurah->foto_warga == 'no-image.png')
            <img class="img-90 rounded" src="{{ asset('assets/images/dashboard/pku.jpg') }}" alt="" />
        @endif
        <a href="">
            <h6 class="mt-3 f-14 f-w-600">Nama lengkap</h6>
            <h6 class="mt-3 f-14 f-w-600">{{ auth()->user()->identitas_lurah->nama_lengkap }}</h6>
        </a>
        <p class="mb-0 font-roboto">RT 1 lurah 1</p>
        <span class="badge badge-primary">Umbansari</span>
        <p class="mb-0 font-roboto">lurah {{ auth()->user()->user_rel->no_lurah }}</p> --}}
    </div>
    <nav>
        {{-- <header class="main-nav">
            <div class="sidebar-user text-center"><a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="{{ asset("assets/images/dashboard/1.png")}}" alt="">
                <div class="badge-bottom"><span class="badge badge-primary">lurah</span></div><a href="{{ route('lurah.profile.show',auth()->user()->id_lurah) }}">
                    <h6 class="mt-3 f-14 f-w-600">{{ auth()->user()->identitas_lurah->nama_lengkap }}</h6>
            </a>
            <p class="mb-0 font-roboto">lurah {{ auth()->user()->no_lurah }}</p>
            </div>
            <nav> --}}
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav" href="{{ route('lurah.dashboard.home') }}"><i
                                data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('lurah.warga.*') }}">
                            <i data-feather="users"></i><span>Warga</span>
                        </a>
                        <ul class="nav-submenu menu-content" style="display:{{ prefixBlock('lurah.surat.*') }};">
                            <li><a href="{{ route('lurah.warga.index') }}" class="{{ prefixActive('lurah.warga.index') }}">Daftar Warga</a></li>
                            <li><a href="{{ route('lurah.warga.wargakepala') }}" class="{{ prefixActive('lurah.warga.wargakepala') }}">Daftar Kepala Keluarga</a></li>
                            <li><a href="{{ route('lurah.warga.wargamiskin') }}" class="{{ prefixActive('lurah.wargaw.wargamiskin') }}">Daftar Warga Miskin</a></li>
                            <li><a href="{{ route('lurah.warga.wargalansia') }}" class="{{ prefixActive('lurah.warga.wargalansia') }}">Daftar Warga Lansia</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav" href="{{ route('lurah.rw.index') }}"><i
                                data-feather="inbox"></i><span>RT/RW</span></a>
                    </li>

                    {{-- <li class="dropdown">
                        <a class="nav-link menu-title  {{ prefixActive('lurah.surat.*') }}">
                            <i data-feather="inbox"></i><span>Surat</span>
                        </a>
                        <ul class="nav-submenu menu-content" style="display:{{ prefixBlock('lurah.surat.*') }};">
                            <li><a href="{{ route('lurah.surat.index') }}"
                                    class="{{ prefixActive('lurah.surat.index') }}">Daftar Pengajuan Surat</a></li>
                            <li><a href="{{ route('lurah.surat.nomorsurat') }}"
                                    class="{{ prefixActive('lurah.surat.nomorsurat') }}">Nomor Surat</a></li>
                             <li><a href="{{ route('lurah.surat.cekSurat') }}"
                                    class="{{ prefixActive('lurah.surat.cekSurat') }}">Cek Surat</a></li>
                        </ul>
                    </li> --}}
                    <li>
                        <a class="nav-link menu-title link-nav" href="{{ route('lurah.kegiatan.index') }}"><i
                                data-feather="calendar"></i><span>Kegiatan</span></a>
                    </li>
                    <li>
                        <a class="nav-link menu-title  link-nav {{ prefixActive('lurah.fasilitas.*') }}"
                            href="{{ route('lurah.fasilitas.index') }}"><i
                                data-feather="map"></i><span>Fasilitas</span></a>
                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav" href="{{ route('lurah.pengumuman.index') }}"><i
                                data-feather="airplay"></i><span>Pengumuman</span></a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav" href="{{ route('lurah.pengaduan.index') }}"><i
                                data-feather="archive"></i><span>Pengaduan</span></a>
                    </li>x
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
<!-- Page Sidebar Ends-->
</nav>
</header>
