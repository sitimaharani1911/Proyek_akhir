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
                style="background-image:url('{{ asset('themes/media/misc/menu-header-bg.jpg') }}')">
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
    <div class="app-navbar-item ms-1 ms-md-3">
        <div class="btn btn-icon btn-custom btn-color-gray-600 btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px position-relative" id="kt_drawer_chat_toggle">
            <i class="ki-outline ki-notification-on fs-1"></i>
            <span id="notification-count" class="position-absolute top-0 start-100 translate-middle badge badge-circle badge-danger w-15px h-15px ms-n4 mt-3">{{ $unreadNotificationsCount }}</span>
        </div>
    </div>
    <div id="kt_drawer_chat" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="chat" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'md': '500px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_drawer_chat_toggle" data-kt-drawer-close="#kt_drawer_chat_close">
        <div class="card w-100 border-0 rounded-0" id="kt_drawer_chat_messenger">
            <div class="card-header pe-5" id="kt_drawer_chat_messenger_header">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Notifikasi</a>
                        <div class="mb-0 lh-1">
                            <span class="badge badge-danger badge-circle w-10px h-10px me-1"></span>
                            <span class="fs-7 fw-semibold text-muted">New</span>
                        </div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" id="kt_drawer_chat_close">
                        <i class="ki-outline ki-cross-square fs-2"></i>
                    </div>
                </div>
            </div>
            <div class="card-body" id="kt_drawer_chat_messenger_body">
                <div class="scroll-y me-n5 pe-5" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_drawer_chat_messenger_header, #kt_drawer_chat_messenger_footer" data-kt-scroll-wrappers="#kt_drawer_chat_messenger_body" data-kt-scroll-offset="0px">
                    @foreach($notifications as $notification)
                        <div class="d-flex justify-content-start mb-10">
                            <div class="d-flex flex-column align-items-start">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="ms-3">
                                        <i class="ki-outline ki-send fs-3"></i>
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">{{ $notification->pesan }}</a>
                                        <span class="text-muted fs-7 mb-1">{{ $notification->created_at }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
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

