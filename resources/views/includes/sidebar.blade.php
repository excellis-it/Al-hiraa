<div class="mdk-drawer  js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__scrim"></div>
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-left simplebar" data-simplebar="">
            <a href="javascript:void(0);" class="navbar-brand main_logo">
                <img class="navbar-brand-icon img-fluid" src="{{ asset('assets/images/logo.png') }}" width=""
                    alt="">
            </a>
            <div class="d-flex align-items-center justify-content-between sidebar-p-a my-4 border-y sidebar-account">
                <a href="@if (Gate::check('Manage Schedule')) {{ route('profile') }} @endif"
                    class="flex d-flex align-items-center text-underline-0 text-body">
                    <span class="avatar me-3">
                        @if (Auth::user()->profile_picture)
                            <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="avatar"
                                class="avatar-img rounded-circle">
                        @else
                            <img src="{{ asset('assets/images/avatar/demi.png') }}" alt="avatar"
                                class="avatar-img rounded-circle">
                        @endif
                    </span>
                    <span class="flex d-flex flex-column">
                        <strong>{{ Auth::user()->full_name }}</strong>
                        <small class="text-muted text-uppercase">{{ Auth::user()->getRoleNames()->first() }}</small>
                    </span>
                </a>
                <div class="dropdown ms-auto">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false" data-caret="false"
                        class="text-muted"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-item-text dropdown-item-text--lh">
                            <div><strong>{{ Auth::user()->full_name }}</strong></div>
                            <div>{{ Auth::user()->email }}</div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('dashboard*') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}">Dashboard</a>
                        @if (Gate::check('Manage Schedule'))
                            <a class="dropdown-item {{ Request::is('profile*') ? 'active' : '' }}"
                                href="{{ route('profile') }}">My profile</a>
                        @endif
                        <a class="dropdown-item {{ Request::is('change-password*') ? 'active' : '' }}"
                            href="{{ route('change.password') }}">Change Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item {{ Request::is('dashboard*') ? 'active open' : '' }} ">
                    <a class="sidebar-menu-button" data-toggle="collapse" href="{{ route('dashboard') }}">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left"><img
                                src="{{ asset('assets/images/sidebar-icon/dashboard.svg') }}"></i>
                        <span class="sidebar-menu-text">Dashboard</span>
                    </a>
                </li>
                @if (Gate::check('Manage Candidate'))
                    <li class="sidebar-menu-item {{ Request::is('candidates*') ? 'active open' : '' }}">
                        <a class="sidebar-menu-button" href="{{ route('candidates.index') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left"><img
                                    src="{{ asset('assets/images/sidebar-icon/user-helmet-safety.svg') }}"></i>
                            <span class="sidebar-menu-text">Candidates</span>
                        </a>
                    </li>
                @endif

                @if (Gate::check('Manage Job'))
                    <li class="sidebar-menu-item {{ Request::is('jobs*') ? 'active open' : '' }}">
                        <a class="sidebar-menu-button" href="{{ route('jobs.index') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left"><img
                                    src="{{ asset('assets/images/sidebar-icon/briefcase.svg') }}"></i>
                            <span class="sidebar-menu-text">Jobs</span>
                        </a>
                    </li>
                @endif

                @if (Gate::check('Manage Company'))
                    <li class="sidebar-menu-item {{ Request::is('companies*') ? 'active open' : '' }}">
                        <a class="sidebar-menu-button" href="{{ route('companies.index') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left"><img
                                    src="{{ asset('assets/images/sidebar-icon/OfficeBuildings.svg') }}"></i>
                            <span class="sidebar-menu-text">Companies</span>
                        </a>
                    </li>
                @endif
                @if (Gate::check('Manage Schedule'))
                    <li class="sidebar-menu-item {{ Request::is('schedule-to-do*') ? 'active open' : '' }}">
                        <a class="sidebar-menu-button" href="{{ route('schedule-to-do.index') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left"><img
                                    src="{{ asset('assets/images/sidebar-icon/calendar.svg') }}"></i>
                            <span class="sidebar-menu-text">Schedule & To-Do</span>
                        </a>
                    </li>
                @endif
                @if (Gate::check('Manage New Registration') || Gate::check('Manage Revenue') || Gate::check('Manage Team Performance'))
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" data-bs-toggle="collapse" href="#collapseReports" role="button"
                            aria-expanded="false" aria-controls="collapseReports">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left"><img
                                    src="{{ asset('assets/images/sidebar-icon/file-medical-alt.svg') }}"></i>
                            <span class="sidebar-menu-text">Reports</span>
                        </a>
                        <ul class="sidebar-submenu collapse" id="collapseReports">
                            @if (Gate::check('Manage New Registration'))
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="">
                                        <span class="sidebar-menu-text">New Registrations</span>
                                    </a>
                                </li>
                            @endif
                            @if (Gate::check('Manage Revenue'))
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="#">
                                        <span class="sidebar-menu-text">Revenue & Collection</span>
                                    </a>
                                </li>
                            @endif
                            @if (Gate::check('Manage Team Performance'))
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="#">
                                        <span class="sidebar-menu-text">Team Performance</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (Gate::check('Manage Team') ||
                        Gate::check('Manage User Access') ||
                        Gate::check('Manage Position') ||
                        Gate::check('Manage Support'))
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" data-bs-toggle="collapse" href="#collapseExample"
                            role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left"><img
                                    src="{{ asset('assets/images/sidebar-icon/setting.svg') }}"></i>
                            <span class="sidebar-menu-text">Settings</span>
                        </a>
                        <ul class="sidebar-submenu collapse" id="collapseExample">
                            @if (Gate::check('Manage Team'))
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="{{ route('members.index') }}">
                                        <span class="sidebar-menu-text">Team Members - List & Details</span>
                                    </a>
                                </li>
                            @endif
                            @if (Gate::check('Manage User Access'))
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="{{ route('user-access.index') }}">
                                        <span class="sidebar-menu-text">User Access Control</span>
                                    </a>
                                </li>
                            @endif

                            @if (Gate::check('Manage Position'))
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="{{ route('positions.index') }}">
                                        <span class="sidebar-menu-text"> Position Manage</span>
                                    </a>
                                </li>
                            @endif
                            {{-- <li class="sidebar-menu-item">
                            <a clas s="sidebar-menu-button" href="{{route('social-media')}}">
                                <span class="sidebar-menu-text">Email & WhatsApp Integration</span>
                            </a>
                        </li> --}}
                            @if (Auth::user()->hasRole('ADMIN'))
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="{{ route('status.index') }}">
                                        <span class="sidebar-menu-text"> Status Manage</span>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->hasRole('ADMIN'))
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="{{ route('sources.index') }}">
                                        <span class="sidebar-menu-text"> Source Manage</span>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->hasRole('ADMIN'))
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="{{ route('cities.index') }}">
                                        <span class="sidebar-menu-text"> City Manage</span>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->hasRole('ADMIN'))
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="{{ route('ip-restrictions.index') }}">
                                        <span class="sidebar-menu-text"> IP Manage</span>
                                    </a>
                                </li>
                            @endif
                            @if (Gate::check('Manage Support'))
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="{{ route('support') }}">
                                        <span class="sidebar-menu-text">Support</span>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->hasRole('ADMIN'))
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="{{ route('contact-us.index') }}">
                                        <span class="sidebar-menu-text">Contact Us</span>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->hasRole('ADMIN'))
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="{{ route('cms.index') }}">
                                        <span class="sidebar-menu-text">Pages</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
            </ul>
            <div class="conversation">
                <h4>Conversations</h4>
                <div class="call_email d-flex align-items-center mb-4">
                    <div class="call_img">
                        <span><img src="{{ asset('assets/images/sidebar-icon/phone-receiver-silhouette.svg') }}"
                                alt="" /></span>
                    </div>
                    <div class="left_call">
                        <span>Call</span>
                        <a href="">(+91)01234-56789</a>
                    </div>
                </div>
                <div class="call_email d-flex align-items-center mb-4">
                    <div class="call_img">
                        <span><img src="{{ asset('assets/images/sidebar-icon/paper-plane.svg') }}"
                                alt="" /></span>
                    </div>
                    <div class="left_call">
                        <span>Email</span>
                        <a href="">support@alhiraa.com</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
