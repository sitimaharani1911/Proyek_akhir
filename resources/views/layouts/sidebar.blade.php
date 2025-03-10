<div class="app-sidebar-navs flex-column-fluid py-6" id="kt_app_sidebar_navs">
    <div id="kt_app_sidebar_navs_wrappers" class="app-sidebar-wrapper hover-scroll-y my-2" data-kt-scroll="true"
        data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_header"
        data-kt-scroll-wrappers="#kt_app_sidebar_navs" data-kt-scroll-offset="5px">
        <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
            class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                    href="{{ route('dashboard.index') }}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-home-2 fs-2"></i>
                    </span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </div><br>
            <div class="menu-item mb-2">
                <div class="menu-heading text-uppercase fs-7 fw-bold">Menu</div>
                <div class="app-sidebar-separator separator"></div>
            </div>
            @if (Auth::user()->role == 'Sentra' || Auth::user()->role == 'Adhoc' || Auth::user()->role == 'superadmin')
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('informasi_hibah.*') ? 'active' : '' }}"
                    href="{{ route('informasi_hibah.index') }}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-abstract-26 fs-2"></i>
                    </span>
                    <span class="menu-title">Informasi Hibah</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('proposal.*') ? 'active' : '' }}"
                    href="{{ route('proposal.index') }}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-abstract-26 fs-2"></i>
                    </span>
                    @if (Auth::user()->role == 'Adhoc' || Auth::user()->role == 'superadmin')
                    <span class="menu-title">Pengajuan Proposal</span>
                    @else
                    <span class="menu-title">Review Proposal</span>
                    @endif
                </a>
            </div>
            @endif
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('progres_proposal.*') ? 'active' : '' }}"
                    href="{{ route('progres_proposal.index') }}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-abstract-26 fs-2"></i>
                    </span>
                    <span class="menu-title">Progres Proposal</span>
                </a>
            </div>
            @if (Auth::user()->role == 'Pelaksana' || Auth::user()->role == 'superadmin')
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('pelaporan.*') ? 'active' : '' }}"
                    href="{{ route('pelaporan.index') }}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-abstract-26 fs-2"></i>
                    </span>
                    <span class="menu-title">Pelaporan</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('pengajuan_dana.*') ? 'active' : '' }}"
                    href="{{ route('pengajuan_dana.index') }}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-abstract-26 fs-2"></i>
                    </span>
                    <span class="menu-title">Pengajuan Dana</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('monev.*') ? 'active' : '' }}"
                    href="{{ route('monev.index') }}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-abstract-26 fs-2"></i>
                    </span>
                    <span class="menu-title">Monev</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('laporan-keuangan.*') ? 'active' : '' }}"
                    href="{{ route('laporan-keuangan.index') }}">
                    <span class="menu-icon">
                        <i class="ki-outline ki-abstract-26 fs-2"></i>
                    </span>
                    <span class="menu-title">Laporan Keuangan</span>
                </a>
            </div>
            @endif
            <div class="menu-item mb-2 mt-4">
                <div class="menu-heading text-uppercase fs-7 fw-bold">Pengaturan</div>
                <div class="app-sidebar-separator separator"></div>
            </div>
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion {{ request()->routeIs('user.index') ? 'show' : '' }}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="ki-outline ki-abstract-35 fs-2"></i>
                    </span>
                    <span class="menu-title">Pengaturan User</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('user.index') ? 'active' : '' }}"
                            href="{{ route('user.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">User</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>