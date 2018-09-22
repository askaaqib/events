<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                {{ __('menus.backend.sidebar.general') }}
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/dashboard')) }}" href="{{ route('admin.dashboard') }}"><i class="icon-speedometer"></i> {{ __('menus.backend.sidebar.dashboard') }}</a>
            </li>

            <li class="nav-title">
                {{ __('menus.backend.sidebar.system') }}
            </li>

            @if ($logged_in_user->isAdmin())
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/auth*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/auth*')) }}" href="#">
                        <i class="icon-user"></i> {{ __('menus.backend.access.title') }}

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/user*')) }}" href="{{ route('admin.auth.user.index') }}">
                                {{ __('labels.backend.access.users.management') }}

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/user/deactivated')) }}" href="{{ route('admin.auth.user.deactivated') }}">
                                {{ __('labels.backend.access.users.deactivated') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/role*')) }}" href="{{ route('admin.auth.role.index') }}">
                                {{ __('labels.backend.access.roles.management') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/venues*')|| Active::checkUriPattern('admin/excludeDates'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/venues*') || Active::checkUriPattern('admin/excludeDates*')) }}" href="#">
                        <i class="icon-user"></i> Venues
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/venues')) }}" href="{{ url('admin/venues') }}">
                                {{ __('labels.backend.venues.all_venues') }}
                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/excludeDates')) }}" href="{{ url('admin/excludeDates') }}">
                                {{ __('labels.backend.venues.exclude_date') }}
                            </a>
                        </li> 
                    </ul>
                </li>
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/events*') || Active::checkUriPattern('admin/riseCapacity*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/events*') || Active::checkUriPattern('admin/riseCapacity*')) }}" href="#">
                        <i class="icon-user"></i> Events
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/events')) }}" href="{{ url('admin/events') }}">
                                {{ __('labels.backend.events.view') }}
                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/riseCapacity')) }}" href="{{ url('admin/riseCapacity') }}">
                                {{ __('labels.backend.riseCapacity.riseCapacity') }}
                            </a>
                        </li>  
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/bookings')) }}" href="{{ url('admin/bookings') }}">
                        {{ __('labels.backend.bookings.view') }}

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>
                </li> 
            </li>
        </ul>
    </nav>
</div><!--sidebar-->