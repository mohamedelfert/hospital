{{--</div>--}}
{{--<!-- Content End -->--}}

<!-- Footer Start -->
<div class="container-fluid bg-dark text-light mt-5 py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Get In Touch</h4>
                <p class="mb-4">{{ LaravelLocalization::getCurrentLocale() === 'ar' ? setting()->site_name_ar:setting()->site_name_en }}</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>{{ setting()->address }}</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>{{ setting()->email }}</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary me-3"></i>{{ setting()->phone }}</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Quick Links</h4>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-light mb-2" href="/"><i class="fa fa-angle-right me-2"></i>@lang('main.home')</a>
                    <a class="text-light mb-2" href="{{ route('about') }}"><i class="fa fa-angle-right me-2"></i>@lang('main.about')</a>
                    <a class="text-light mb-2" href="{{ route('specialties') }}"><i class="fa fa-angle-right me-2"></i>@lang('main.specialties')</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Popular Links</h4>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-light mb-2" href="{{ route('doctors') }}"><i class="fa fa-angle-right me-2"></i>@lang('main.doctors')</a>
                    <a class="text-light mb-2" href="{{ route('reservation.show') }}"><i class="fa fa-angle-right me-2"></i>@lang('main.book_reservation')</a>
                    <a class="text-light" href="{{ route('contact') }}"><i class="fa fa-angle-right me-2"></i>@lang('main.contact')</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Newsletter</h4>
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-3 border-0" placeholder="Your Email Address">
                        <button class="btn btn-primary">Sign Up</button>
                    </div>
                </form>
                <h6 class="text-primary text-uppercase mt-4 mb-3">Follow Us</h6>
                <div class="d-flex">
                    <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="{{ setting()->twitter }}" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="{{ setting()->facebook }}" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="{{ setting()->instagram }}" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="btn btn-lg btn-primary btn-lg-square rounded-circle" href="{{ 'https://wa.me/'.setting()->phone }}" target="_blank">
                        <i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid bg-dark text-light border-top border-secondary py-4">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-md-0">&copy; <a class="text-primary" href="#">
                        {{ LaravelLocalization::getCurrentLocale() === 'ar' ? setting()->site_name_ar:setting()->site_name_en }}
                    </a>. All Rights Reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="mb-0">Designed by <a class="text-primary" href="#">HTML Codex</a></p>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->
