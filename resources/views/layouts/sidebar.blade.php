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
            <div class="menu-item">
                <a class="menu-link" href="">
                    <span class="menu-icon">
                        <i class="ki-outline ki-abstract-26 fs-2"></i>
                    </span>
                    <span class="menu-title">Menu</span>
                </a>
            </div>
        </div>
    </div>
</div>