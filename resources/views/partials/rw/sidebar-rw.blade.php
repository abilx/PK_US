<header class="main-nav">
    <div class="sidebar-user text-center">
        {{-- <a class="setting-primary" href="{{ route('rw.profile.show', auth()->user()->_warga->id_warga) }}">
            <i data-feather="settings"></i>
        </a>
        @if (auth()->user()->identitas_rw->foto_warga == 'no-image.png')
            <img class="img-90 rounded" src="{{ asset('assets/images/dashboard/pku.jpg') }}" alt="" />
        @endif
        <a href="">
            <h6 class="mt-3 f-14 f-w-600">Nama lengkap</h6>
            <h6 class="mt-3 f-14 f-w-600">{{ auth()->user()->identitas_rw->nama_lengkap }}</h6>
        </a>
        <p class="mb-0 font-roboto">RT 1 RW 1</p>
        <span class="badge badge-primary">Umbansari</span>
        <p class="mb-0 font-roboto">RW {{ auth()->user()->user_rel->no_rw }}</p> --}}
    </div>
    <nav>
        {{-- <header class="main-nav">
            <div class="sidebar-user text-center"><a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="{{ asset("assets/images/dashboard/1.png")}}" alt="">
                <div class="badge-bottom"><span class="badge badge-primary">RW</span></div><a href="{{ route('rw.profile.show',auth()->user()->id_rw) }}">
                    <h6 class="mt-3 f-14 f-w-600">{{ auth()->user()->identitas_rw->nama_lengkap }}</h6>
            </a>
            <p class="mb-0 font-roboto">RW {{ auth()->user()->no_rw }}</p>
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
                    {{-- <li class="sidebar-main-title">
                        <div>
                            <h6>Dashboard Menu</h6>
                        </div>
                    </li> --}}
                    <li>
                        <a class="nav-link menu-title link-nav" href="{{ route('rw.dashboard.home') }}"><i
                                data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('rw.warga.*') }}">
                            <i data-feather="users"></i><span>Warga</span>
                        </a>
                        <ul class="nav-submenu menu-content" style="display:{{ prefixBlock('rw.surat.*') }};">
                            <li><a href="{{ route('rw.warga.index') }}" class="{{ prefixActive('rw.warga.index') }}">Daftar Warga</a></li>
                            <li><a href="{{ route('rw.warga.wargakepala') }}" class="{{ prefixActive('rw.warga.wargakepala') }}">Daftar Kepala Keluarga</a></li>
                            <li><a href="{{ route('rw.warga.wargamiskin') }}" class="{{ prefixActive('rw.warga.wargamiskin') }}">Daftar Warga Miskin</a></li>
                            <li><a href="{{ route('rw.warga.wargalansia') }}" class="{{ prefixActive('rw.warga.wargalansia') }}">Daftar Warga Lansia</a></li>
                        </ul>
                    </li>
                    {{-- <li class="dropdown">
                        <a class="nav-link menu-title  {{ prefixActive('rw.surat.*') }}">
                            <i data-feather="inbox"></i><span>Surat</span>
                        </a>
                        <ul class="nav-submenu menu-content" style="display:{{ prefixBlock('rw.surat.*') }};">
                            <li><a href="{{ route('rw.surat.index') }}"
                                    class="{{ prefixActive('rw.surat.index') }}">Daftar Pengajuan Surat</a></li>
                            <li><a href="{{ route('rw.surat.nomorsurat') }}"
                                    class="{{ prefixActive('rw.surat.nomorsurat') }}">Nomor Surat</a></li>
                             <li><a href="{{ route('rw.surat.cekSurat') }}"
                                    class="{{ prefixActive('rw.surat.cekSurat') }}">Cek Surat</a></li>
                        </ul>
                    </li> --}}
                    <li>
                        <a class="nav-link menu-title link-nav" href="{{ route('rw.kegiatan.index') }}"><i
                                data-feather="calendar"></i><span>Kegiatan</span></a>
                    </li>
                    <li>
                        <a class="nav-link menu-title  link-nav {{ prefixActive('rw.fasilitasrw.*') }}"
                            href="{{ route('rw.fasilitasrw.index') }}"><i
                                data-feather="map"></i><span>Fasilitas</span></a>
                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav" href="{{ route('rw.pengumuman.index') }}"><i
                                data-feather="airplay"></i><span>Pengumuman</span></a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav" href="{{ route('rw.pengaduan.index') }}"><i
                                data-feather="archive"></i><span>Pengaduan</span></a>
                    </li>
                    {{-- <li>
                        <a class="nav-link menu-title link-nav" href="{{ route('rw.profile.show', auth()->user()->user_rel->id_rw) }}">
                            <i data-feather="settings"></i><span>Edit Profil</span>
                        </a>
                    </li> --}}
                    {{-- <li class="sidebar-main-title">
                        <div>
                            <h6>Lainya</h6>
                        </div>
                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav" href="{{ route('rw.profile.show', auth()->user()->user_rel->id_rw) }}">
                            <i data-feather="settings"></i><span>Pengaturan</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav">
                        <form action="{{ route('logout') }}" class="m-0" method="POST">
                            @csrf
                            <button class="btn btn-primary-light">
                                <i data-feather="log-out"></i><span>Keluar</span>
                            </button>
                        </form>
                        </a>
                    </li> --}}
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
<!-- Page Sidebar Ends-->
</nav>
</header>
