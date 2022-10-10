<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/' . $page='home') }}"><img
                src="{{ setting()->logo_path }}" class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="{{ url('/' . $page='home') }}"><img
                src="{{ setting()->logo_path }}" class="main-logo dark-theme" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='home') }}"><img
                src="{{ setting()->logo_path }}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='home') }}"><img
                src="{{ setting()->logo_path }}" class="logo-icon dark-theme" alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround" src="{{ auth()->user()->image_path }}"><span
                        class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h4>
                    <span class="mb-0 text-muted">{{ auth()->user()->role_name }}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <!-- Dashboard -->
            <li class="slide">
                <a class="side-menu__item" href="{{ route('dashboard.index') }}">
                    <i class="side-menu__icon fa fa-home"></i>
                    <span class="side-menu__label">@lang('main.dashboard')</span>
                </a>
            </li>
            <!-- Dashboard -->

            <!-- Specialties -->
            @can('specialty-list')
                <li class="side-item side-item-category">@lang('main.specialties')</li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('dashboard.specialties.index') }}">
                        <i class="side-menu__icon fa fa-eye"></i>
                        <span class="side-menu__label">@lang('main.specialties')</span>
                    </a>
                </li>
            @endcan
            <!-- Specialties -->

            <!-- Doctors -->
            @can('doctor-list')
                <li class="side-item side-item-category">@lang('main.doctors')</li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('dashboard.doctors.index') }}">
                        <i class="side-menu__icon fa fa-hospital"></i>
                        <span class="side-menu__label">@lang('main.doctors')</span>
                    </a>
                </li>
            @endcan
            <!-- Doctors -->

            <!-- Reservations -->
            @can('reservation-list')
                <li class="side-item side-item-category">@lang('main.reservations')</li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('dashboard.reservations.index') }}">
                        <i class="side-menu__icon fa fa-ticket-alt"></i>
                        <span class="side-menu__label">@lang('main.reservations')</span>
                    </a>
                </li>
            @endcan
            <!-- Reservations -->

            <!-- Examinations -->
            @can('examination-list')
                <li class="side-item side-item-category">@lang('main.examinations')</li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('dashboard.examinations.index') }}">
                        <i class="side-menu__icon fa fa-bookmark"></i>
                        <span class="side-menu__label">@lang('main.examinations')</span>
                    </a>
                </li>
            @endcan
            <!-- Examinations -->

            <!-- Workdays -->
            @can('workday-list')
                <li class="side-item side-item-category">@lang('main.workdays')</li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('dashboard.workdays.index') }}">
                        <i class="side-menu__icon fa fa-calendar-day"></i>
                        <span class="side-menu__label">@lang('main.workdays')</span>
                    </a>
                </li>
            @endcan
            <!-- Workdays -->

            <!-- List Price -->
            @can('price-list')
                <li class="side-item side-item-category">@lang('main.prices')</li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('dashboard.prices.index') }}">
                        <i class="side-menu__icon fa fa-money-bill"></i>
                        <span class="side-menu__label">@lang('main.prices')</span>
                    </a>
                </li>
            @endcan
            <!-- List Price -->

            <!-- Users & Roles -->
            @can('user-list')
                <li class="side-item side-item-category">@lang('main.users_permissions')</li>
                @can('user-list')
                    <li class="slide">
                    <a class="side-menu__item" href="{{ route('dashboard.users.index') }}">
                        <i class="side-menu__icon fa fa-users"></i>
                        <span class="side-menu__label">@lang('main.users')</span>
                    </a>
                </li>
                @endcan
                @can('role-list')
                    <li class="slide">
                    <a class="side-menu__item" href="{{ route('dashboard.roles.index') }}">
                        <i class="side-menu__icon fa fa-shield-alt"></i>
                        <span class="side-menu__label">@lang('main.roles')</span>
                    </a>
                </li>
                @endcan
            @endcan
            <!-- Users & Roles -->

            <!-- Settings -->
            @can('setting-list')
                <li class="side-item side-item-category">@lang('main.settings')</li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('dashboard.settings.index') }}">
                        <i class="side-menu__icon fa fa-cogs"></i>
                        <span class="side-menu__label">@lang('main.settings')</span>
                    </a>
                </li>
            @endcan
            <!-- Settings -->
        </ul>
    </div>
</aside>
<!-- main-sidebar -->
<div class="main-content app-content">
