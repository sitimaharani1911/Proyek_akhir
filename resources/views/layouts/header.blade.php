<div class="app-navbar flex-lg-grow-1" id="kt_app_header_navbar">
    <div class="app-navbar-item d-flex align-items-stretch flex-lg-grow-1">
    </div>
    <div class="app-navbar-item ms-1 ms-md-3">
        <?php
        $userRoles = DB::table('role_users')->where('user_id', Auth::id())->get();
        if(count($userRoles) > 1):
        ?>
        <div class="btn btn-icon btn-custom btn-color-gray-600 btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end">
            <i class="ki-outline ki-abstract-26 fs-1"></i>
        </div>
        <div class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px" data-kt-menu="true">
            <div class="d-flex flex-column flex-center bgi-no-repeat rounded-top px-9 py-10"
                style="background-image:url('themes/media/misc/menu-header-bg.jpg')">
                <h3 class="text-white fw-semibold mb-3">Switch Account</h3>
                <span class="badge bg-primary text-inverse-primary py-2 px-3">{{ session('selected_role') }}</span>
            </div>
            <div class="row g-0">
                <?php foreach($userRoles as $index => $userRole): ?>
                <div class="col-6">
                    <form method="POST" action="{{ route('set.role') }}" class="h-100">
                        @csrf
                        <input type="hidden" name="role" value="{{ $userRole->role }}">
                        <button type="submit"
                            class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end w-100"
                            style="border: none; background: none;">
                            <i class="ki-outline ki-abstract-41 fs-3x text-primary mb-2"></i>
                            <span class="fs-5 fw-semibold text-gray-800 mb-0">{{ ucfirst($userRole->role) }}</span>
                            @if (session('selected_role') == $userRole->role)
                                <span class="badge badge-primary mt-2">Active</span>
                            @endif
                        </button>
                    </form>
                </div>
                <?php if($index % 2 != 0 && $index < count($userRoles) - 1): ?>
            </div>
            <div class="row g-0">
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
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
                        <div class="fw-bold d-flex align-items-center fs-5">{{ Auth::user()->name }}
                        </div>
                        <a href="#"
                            class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->role }}</a>
                    </div>
                </div>
            </div>
            <div class="menu-item px-5">
                <a href="{{ route('logout') }}" class="menu-link px-5">Sign Out</a>
            </div>
        </div>
    </div>
</div>
