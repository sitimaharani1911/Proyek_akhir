<div class="app-navbar flex-lg-grow-1" id="kt_app_header_navbar">
    <div class="app-navbar-item d-flex align-items-stretch flex-lg-grow-1">
    </div>
    <div class="app-navbar-item ms-1 ms-md-3" id="kt_header_user_menu_toggle">
        <div class="cursor-pointer symbol symbol-circle symbol-35px symbol-md-45px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end">
            <img src="{{ asset('themes/media/avatars/blank.png') }}" alt="user" />
        </div>
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
            data-kt-menu="true">
            <div class="menu-item px-3">
                <div class="menu-content d-flex align-items-center px-3">
                    <div class="symbol symbol-50px me-5">
                        <img alt="Logo" src="{{ asset('themes/media/avatars/blank.png') }}" />
                    </div>
                    <div class="d-flex flex-column">
                        <div class="fw-bold d-flex align-items-center fs-5">Max Smith
                        </div>
                        <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">max@kt.com</a>
                    </div>
                </div>
            </div>
            <div class="menu-item px-5">
                <a href="authentication/layouts/corporate/sign-in.html" class="menu-link px-5">Sign Out</a>
            </div>
        </div>
    </div>
</div>
