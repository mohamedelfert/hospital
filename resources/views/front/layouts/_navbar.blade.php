<!-- Topbar Start -->
<div class="container-fluid py-2 border-bottom d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <a class="text-decoration-none text-body pe-3" href=""><i class="bi bi-telephone me-2"></i>{{ setting()->phone }}</a>
                    <span class="text-body">|</span>
                    <a class="text-decoration-none text-body px-3" href=""><i class="bi bi-envelope me-2"></i>{{ setting()->email }}</a>
                </div>
            </div>
            <div class="col-md-6 text-center text-lg-end">
                <div class="d-inline-flex align-items-center">
                    <small><i class="far fa-clock text-primary me-2"></i>Opening Hours: 24 / 7 Opened </small>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<div class="container-fluid sticky-top bg-white shadow-sm">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
            <a href="" class="navbar-brand">
                <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-clinic-medical me-2"></i>
                    {{ LaravelLocalization::getCurrentLocale() === 'ar' ? setting()->site_name_ar:setting()->site_name_en }}
                </h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="/" class="nav-item nav-link active">@lang('main.home')</a>
                    <a href="{{ route('about') }}" class="nav-item nav-link">@lang('main.about')</a>
                    <a href="{{ route('specialties') }}" class="nav-item nav-link">@lang('main.specialties')</a>
                    <a href="{{ route('doctors') }}" class="nav-item nav-link">@lang('main.doctors')</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">@lang('main.more')</a>
                        <div class="dropdown-menu m-0">
                            <a href="{{ route('reservation.show') }}" class="dropdown-item">@lang('main.reservation')</a>
                            <a href="{{ route('schedule') }}" class="dropdown-item">@lang('main.times_of_doctors')</a>
                            <a href="{{ route('findDoctor') }}" class="dropdown-item">@lang('main.find_doctor')</a>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="nav-item nav-link">@lang('main.contact')</a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->

{{--<!-- Content Start -->--}}
{{--<div class="container-fluid my-5 py-5">--}}
