<header class="main-nav">
    <div class="sidebar-user text-center">
        <img
            class="img-90 rounded-circle" src="{{ asset('assets/images/dashboard/1.png') }}" alt="" />
        <div class="badge-bottom"><span class="badge badge-primary">RT</span></div>
        {{-- <a href="user-profile">
            <h6 class="mt-3 f-14 f-w-600">Nama lengkap</h6>
            <h6 class="mt-3 f-14 f-w-600">{{ auth()->user()->identitas_rt->nama_lengkap }}</h6>
        </a> --}}
        {{-- <p class="mb-0 font-roboto">RT 1 RW 1</p>
        <p class="mb-0 font-roboto">RT {{ auth()->user()->no_rt }} RW {{ auth()->user()->rw_rel->no_rw }}</p> --}}
    </div>
    <nav>
        <header class="main-nav">
            <div class="sidebar-user text-center"><img class="img-90 rounded-circle" src="{{ asset("assets/images/dashboard/1.png")}}" alt="">
                <div class="badge-bottom"><span class="badge badge-primary">RW</span></div><a href="user-profile.html">
                    <h6 class="mt-3 f-14 f-w-600">Admin</h6>
            </a>
            <p class="mb-0 font-roboto">Admin</p>
            </div>
            <nav>
                <div class="main-navbar">
                    <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                    <div id="mainnav">
                        <ul class="nav-menu custom-scrollbar">
                            <li class="back-btn">
                                <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                            </li>
                            <li class="sidebar-main-title">
                                <div>
                                    <h6>Kelurahan Umban Sari</h6>
                                </div>
                            </li>
                            <li>
                                <a class="nav-link menu-title link-nav" href="{{ route('admin.dashboard.home') }}"><i
                                        data-feather="home"></i><span>Dashboard</span></a>
                            </li>
                            <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="users"></i><span>Kelola User</span></a>
                                <ul class="nav-submenu menu-content">
                                    {{-- <li><a href="{{ route('rt.index') }}">Daftar RT</a></li> --}}
                                    <li><a href="{{ route('pk.index') }}">Daftar Petugas Kelurahan</a></li>
                                    <li><a href="{{ route('rw.index') }}">Daftar RW</a></li>
                                    <li><a href="{{ route('rt.index') }}">Daftar RT</a></li>
                                    <li><a href="{{ route('warga.index') }}">Daftar Warga</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i
                                data-feather="airplay"></i><span>Kelola Utilitas</span></a>
                                <ul class="nav-submenu menu-content">
                                    <li><a href="{{ route('kategori_pengumuman.index') }}">Kategori Pengumuman</a></li>
                                    {{-- <li><a href="{{ route('rt.jenis_iuran.index') }}">Jenis Iuran</a></li> --}}
                                    <li><a href="{{ route('kategori_kegiatan.index') }}">Kategori Kegiatan</a></li>
                                    <li><a href="{{ route('kategori_pengaduan.index') }}">Kategori Pengaduan</a></li>
                                    <li><a href="{{ route('kategori_fasilitas.index') }}">Kategori Fasilitas</a></li>
                                    {{-- <li><a href="{{ route('rt.agama.index') }}">Agama</a></li> --}}
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
                </div>
            </nav>
        </header>
        <!-- Page Sidebar Ends-->
    </nav>
</header>
