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
            @if (Auth::user()->role == 'Adhoc' ||
                    Auth::user()->role == 'superadmin' ||
                    Auth::user()->role == 'Sentra' ||
                    Auth::user()->role == 'Pelaksana' ||
                    Auth::user()->role == 'Direktur' ||
                    Auth::user()->role == 'Kesekretariatan' ||
                    Auth::user()->role == 'PIU' ||
                    Auth::user()->role == 'Keuangan')
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('informasi_hibah.*') ? 'active' : '' }}"
                        href="{{ route('informasi_hibah.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-newspaper fs-2"></i>
                        </span>
                        <span class="menu-title">Informasi Hibah</span>
                    </a>
                </div>
            @endif
            @if (Auth::user()->role == 'Adhoc' || Auth::user()->role == 'superadmin')
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('proposal.*') ? 'active' : '' }}"
                        href="{{ route('proposal.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-journals fs-2"></i>
                        </span>
                        <span class="menu-title">Pengajuan Proposal</span>
                    </a>
                </div>
            @endif
            @if (Auth::user()->role == 'Sentra' ||
                    Auth::user()->role == 'superadmin' ||
                    Auth::user()->role == 'PIU' ||
                    Auth::user()->role == 'Direktur' ||
                    Auth::user()->role == 'Kesekretariatan')
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('proposal.*') ? 'active' : '' }}"
                        href="{{ route('proposal.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-clipboard-check fs-2"></i>
                        </span>
                        <span class="menu-title">Review Proposal</span>
                    </a>
                </div>
            @endif
            @if (Auth::user()->role == 'Sentra' ||
                    Auth::user()->role == 'Pelaksana' ||
                    Auth::user()->role == 'superadmin' ||
                    Auth::user()->role == 'PIU' ||
                    Auth::user()->role == 'Direktur' ||
                    Auth::user()->role == 'Kesekretariatan' ||
                    Auth::user()->role == 'Adhoc')
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('progres_proposal.*') ? 'active' : '' }}"
                        href="{{ route('progres_proposal.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-bar-chart fs-2"></i>
                        </span>
                        <span class="menu-title">Status Penerimaan Eksternal</span>
                    </a>
                </div>
            @endif

            {{-- <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('rab.*') ? 'active' : '' }}"
                    href="{{ route('rab.index') }}">
                    <span class="menu-icon">
                        <i class="bi bi-cash-coin fs-2"></i>
                    </span>
                    <span class="menu-title">RAB</span>
                </a>
            </div> --}}
            @if (Auth::user()->role == 'Kesekretariatan' || Auth::user()->role == 'superadmin')
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('pengesahan_berkas.*') ? 'active' : '' }}"
                        href="{{ route('pengesahan_berkas.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-file-earmark-arrow-up fs-2"></i>
                        </span>
                        <span class="menu-title">Pengesahan Berkas</span>
                    </a>
                </div>
            @endif
            @if (Auth::user()->role == 'Pelaksana' || Auth::user()->role == 'superadmin')
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('list-kegiatan.*') ? 'active' : '' }}"
                        href="{{ route('list-kegiatan.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-card-list fs-2"></i>
                        </span>
                        <span class="menu-title">List Kegiatan</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('pelaporan.*') || request()->routeIs('kegiatan.*') ? 'active' : '' }}"
                        href="{{ route('pelaporan.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-journal-text fs-2"></i>
                        </span>
                        <span class="menu-title">Pelaporan</span>
                    </a>
                </div>
            @endif
            @if (Auth::user()->role == 'Monev' || Auth::user()->role == 'superadmin')
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('monev-kegiatan.*') ? 'active' : '' }}"
                        href="{{ route('monev-kegiatan.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-calendar4-event fs-2"></i>
                        </span>
                        <span class="menu-title">List Kegiatan</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('monev.*') ? 'active' : '' }}"
                        href="{{ route('monev.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-cast fs-2"></i>
                        </span>
                        <span class="menu-title">Monev</span>
                    </a>
                </div>
            @endif
            @if (Auth::user()->role == 'Keuangan' || Auth::user()->role == 'superadmin')
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('laporan-keuangan.*') ? 'active' : '' }}"
                        href="{{ route('laporan-keuangan.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-journal-bookmark fs-2"></i>
                        </span>
                        <span class="menu-title">Laporan Keuangan</span>
                    </a>
                </div>
            @endif
            @if (Auth::user()->role == 'PIU' || Auth::user()->role == 'superadmin')
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('piu.*') ? 'active' : '' }}"
                        href="{{ route('piu.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-journal-check fs-2"></i>
                        </span>
                        <span class="menu-title">Verifikasi Monev PIU</span>
                    </a>
                </div>
            @endif
            @if (Auth::user()->role == 'Direktur' || Auth::user()->role == 'superadmin')
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('pimpinan.*') ? 'active' : '' }}"
                        href="{{ route('pimpinan.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-journal-check fs-2"></i>
                        </span>
                        <span class="menu-title">Verifikasi Monev Pimpinan</span>
                    </a>
                </div>
            @endif
            @if (Auth::user()->role == 'superadmin')
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
            @endif
            @if (Auth::user()->role == 'superadmin')
                <div class="menu-item mb-2">
                    <div class="menu-heading text-uppercase fs-7 fw-bold">Master</div>
                    <div class="app-sidebar-separator separator"></div>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('skema_hibah.*') ? 'active' : '' }}"
                        href="{{ route('skema_hibah.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-cast fs-2"></i>
                        </span>
                        <span class="menu-title">Skema Hibah</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
