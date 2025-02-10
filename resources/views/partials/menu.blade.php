<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo mb-3">

        <a href="{{ route('/') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/logo/logo.png') }}" alt="" width="40">
            </span>
            <span class="fw-bold ms-2 text-2xl">Metrokil</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="align-middle bx bx-chevron-left bx-sm"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="py-1 menu-inner">

        {{-- Admin --}}
        <li class="menu-item {{ request()->is('home') ? 'active' : '' }}">
            <a href="{{ route('home.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Beranda">Beranda</div>
            </a>
        </li>

        @role('Administrator')
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Operasional</span>
            </li>

            <li class="menu-item {{ request()->is('blogs*') ? 'open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-news"></i>
                    <div data-i18n="Kelola Pengguna">Blog</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('blogs') ? 'active' : '' }}">
                        <a href="{{ route('blogs.index') }}" class="menu-link">
                            <div data-i18n="Pengguna">Daftar Blog</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('blogs/create') ? 'active' : '' }}">
                        <a href="{{ route('blogs.create') }}" class="menu-link">
                            <div data-i18n="Pengguna">Tambah Blog</div>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item {{ request()->is('galleries*') ? 'open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-film"></i>
                    <div data-i18n="Kelola Pengguna">Gallery</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('galleries') ? 'active' : '' }}">
                        <a href="{{ route('galleries.index') }}" class="menu-link">
                            <div data-i18n="Pengguna">Daftar Gallery</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('galleries/create') ? 'active' : '' }}">
                        <a href="{{ route('galleries.create') }}" class="menu-link">
                            <div data-i18n="Pengguna">Tambah Gallery</div>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item {{ request()->is('blogs*') ? 'open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-briefcase-alt"></i>
                    <div data-i18n="Kelola Pengguna">Services</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('blogs') ? 'active' : '' }}">
                        <a href="{{ route('blogs.index') }}" class="menu-link">
                            <div data-i18n="Pengguna">Daftar Services</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('blogs/create') ? 'active' : '' }}">
                        <a href="{{ route('blogs.create') }}" class="menu-link">
                            <div data-i18n="Pengguna">Tambah Services</div>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">System Management</span>
            </li>

            <li class="menu-item {{ request()->is('users') ? 'open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-cog"></i>
                    <div data-i18n="Pengaturan Sistem">Pengaturan Sistem</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <div data-i18n="Pengaturan">Pengaturan</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endrole
    </ul>
</aside>
