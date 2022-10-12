@extends('front.layouts.app')

{{--@section('title')--}}
{{--    Title Here--}}
{{--@endsection--}}
@push('css')
@endpush

@section('content')

    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-8 text-center text-lg-start">
                    <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5" style="border-color: rgba(256, 256, 256, .3) !important;">
                        {{ LaravelLocalization::getCurrentLocale() === 'ar' ? 'أهلا بك في '.setting()->site_name_ar:'Welcome to '.setting()->site_name_en }}
                    </h5>
                    <h1 class="display-1 text-white mb-md-4">Best Healthcare Solution In Your City</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Banner Start -->
    <div class="container-fluid banner mb-3">
        <div class="container">
            <div class="row gx-0">
                <div class="col-lg-6">
                    <form method="POST" action="{{ route('search') }}">
                        {{ csrf_field() }}
                        <div class="bg-dark d-flex flex-column p-5" style="height: 300px;">
                            <h3 class="text-white mb-3">@lang('main.find_doctor')</h3>
                            <select name="specialty_id" class="form-select bg-light border-0 mb-3" style="height: 40px;">
                                <option value="">@lang('main.choose_specialty')</option>
                                @foreach($specialties as $specialty)
                                    <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-light" type="submit">@lang('main.search')</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="bg-secondary d-flex flex-column p-5" style="height: 300px;">
                        <h3 class="text-white mb-3">Make Appointment</h3>
                        <p class="text-white">You Can Make Appointment By Calling This Number Or Go To Appointment Form By clicking This Button</p>
                        <h2 class="text-white mb-3">{{ setting()->phone }}</h2>
                        <a class="btn btn-light" href="{{ route('reservation.show') }}">@lang('main.book_reservation')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title mb-4">
                        <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">About Us</h5>
                        <h1 class="display-4">Best Medical Care For Yourself and Your Family</h1>
                    </div>
                    <h4 class="text-body fst-italic mb-4">Diam dolor diam ipsum sit. Clita erat ipsum et lorem stet no lorem sit clita duo justo magna dolore</h4>
                    <p class="mb-4">{{ setting()->description }}</p>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>Award Winning</h5>
                            <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>Professional Staff</h5>
                        </div>
                        <div class="col-sm-6">
                            <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>24/7 Opened</h5>
                            <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>Fair Prices</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row g-3 pt-3">
                        <div class="col-sm-3 col-6">
                            <div class="bg-light text-center rounded-circle py-4">
                                <i class="fa fa-3x fa-user-md text-primary mb-3"></i>
                                <h6 class="mb-0">Qualified<small class="d-block text-primary">Doctors</small></h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="bg-light text-center rounded-circle py-4">
                                <i class="fa fa-3x fa-procedures text-primary mb-3"></i>
                                <h6 class="mb-0">Emergency<small class="d-block text-primary">Services</small></h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="bg-light text-center rounded-circle py-4">
                                <i class="fa fa-3x fa-microscope text-primary mb-3"></i>
                                <h6 class="mb-0">Accurate<small class="d-block text-primary">Testing</small></h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="bg-light text-center rounded-circle py-4">
                                <i class="fa fa-3x fa-ambulance text-primary mb-3"></i>
                                <h6 class="mb-0">Free<small class="d-block text-primary">Ambulance</small></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded" alt="" src="{{ asset('front/img/about.jpg') }}" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Services Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Services</h5>
                <h1 class="display-4">Excellent Medical Services</h1>
            </div>
            <div class="row g-5">
                <div class="row g-5">
                    @foreach(\App\Models\Specialty::latest()->paginate(3) as $specialty)
                        <div class="col-lg-4 col-md-6">
                            <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="service-icon mb-4">
                                    <i class="fa fa-2x fa-user-md text-white"></i>
                                </div>
                                <h4 class="mb-3">{{ $specialty->name }}</h4>
                                <p class="m-0">{{ $specialty->notes }}</p>
                                <a class="btn btn-lg btn-primary rounded-pill" href="{{ route('specialties') }}">
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->

    <!-- Appointment Start -->
    <div class="container-fluid bg-primary my-5 py-5">
        <div class="container py-5">
            <div class="row gx-5">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="mb-4">
                        <h5 class="d-inline-block text-white text-uppercase border-bottom border-5">@lang('main.reservations')</h5>
                        <h1 class="display-4">@lang('main.reservation')</h1>
                    </div>
                    <p class="text-white mb-5">Eirmod sed tempor lorem ut dolores. Aliquyam sit sadipscing kasd ipsum. Dolor ea et dolore et at sea ea at dolor, justo ipsum duo rebum sea invidunt voluptua. Eos vero eos vero ea et dolore eirmod et. Dolores diam duo invidunt lorem. Elitr ut dolores magna sit. Sea dolore sanctus sed et. Takimata takimata sanctus sed.</p>
                    <a class="btn btn-dark rounded-pill py-3 px-5 me-3" href="{{ route('doctors') }}">@lang('main.find_doctor')</a>
                </div>
                <div class="col-lg-6">
                    <div class="bg-white text-center rounded p-5">
                        <h1 class="mb-4">@lang('main.reservation')</h1>
                        <form action="{{ route('reservation') }}" method="post">
                            {{ csrf_field() }}

                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <select name="examination_id" class="form-select bg-light border-0" style="height: 55px;" required>
                                        <option value="">@lang('main.choose_examination')</option>
                                        @foreach(\App\Models\Examination::all() as $examination)
                                            <option value="{{ $examination->id }}">{{ $examination->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('examination_id')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-12 col-sm-6">
                                    <select name="specialty_id" class="form-select bg-light border-0" style="height: 55px;" required>
                                        <option value="">@lang('main.choose_specialty')</option>
                                        @foreach(\App\Models\Specialty::all() as $specialty)
                                            <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('specialty_id')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-12 col-sm-4">
                                    <select name="doctor_id" class="form-select bg-light border-0" style="height: 55px;" required>
                                        <option value="">@lang('main.choose_doctor')</option>
                                    </select>
                                    @error('doctor_id')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-12 col-sm-4">
                                    <select name="day_id" class="form-select bg-light border-0" style="height: 55px;" required>
                                        <option value="">@lang('main.choose_day')</option>
                                    </select>
                                    @error('day_id')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="date" id="date" data-target-input="nearest">
                                        <input type="date" name="date" id="date" value="{{ old('date') }}"
                                               class="form-control bg-light border-0 datetimepicker-input"
                                               placeholder="Date" data-target="#date" data-toggle="datetimepicker" required style="height: 55px;">
                                    </div>
                                    @error('date')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-12 col-sm-6">
                                    <input type="text" name="name" class="form-control bg-light border-0" value="{{ old('name') }}"
                                           placeholder="Your Name" required style="height: 55px;">
                                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-12 col-sm-3">
                                    <select name="gender" class="form-select bg-light border-0" style="height: 55px;" required>
                                        <option value="">@lang('main.choose_gender')</option>
                                        <option value="male">@lang('main.male')</option>
                                        <option value="female">@lang('main.female')</option>
                                    </select>
                                    @error('gender')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-12 col-sm-3">
                                    <input type="number" name="age" class="form-control bg-light border-0"
                                           min="0" max="100" step="0.1" value="{{ old('age') }}"
                                           placeholder="Your Age" required style="height: 55px;">
                                    @error('age')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-12 col-sm-6">
                                    <input type="text" name="phone" class="form-control bg-light border-0" value="{{ old('phone') }}"
                                           placeholder="Your Phone" required style="height: 55px;">
                                    @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-12 col-sm-6">
                                    <input type="text" name="address" class="form-control bg-light border-0" value="{{ old('address') }}"
                                           placeholder="Your Address" required style="height: 55px;">
                                    @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">@lang('main.book_reservation')</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->

    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Our Doctors</h5>
                <h1 class="display-4">Qualified Healthcare Professionals</h1>
            </div>
            <div class="owl-carousel team-carousel position-relative">
                @foreach(\App\Models\Doctor::latest()->paginate(4) as $doctor)
                    <div class="team-item">
                    <div class="row g-0 bg-light rounded overflow-hidden">
                        <div class="col-12 col-sm-5 h-100">
                            <img class="img-fluid h-100" src="{{ $doctor->image_path }}" style="object-fit: cover;">
                        </div>
                        <div class="col-12 col-sm-7 h-100 d-flex flex-column">
                            <div class="mt-auto p-4">
                                <h3>{{ $doctor->name }}</h3>
                                <h6 class="fw-normal fst-italic text-primary mb-4">{{ $doctor->specialty->name }}</h6>
                                <p class="m-0">{{ $doctor->address }}</p>
                            </div>
                            <div class="d-flex mt-auto border-top p-4">
                                <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-3" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-3" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-lg btn-primary btn-lg-square rounded-circle" href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Team End -->

@endsection
@push('js')
    <script>
        // This for doctors name
        $(document).ready(function () {
            $('select[name="specialty_id"]').on('change', function () {
                let specialty_id = $(this).val();
                if (specialty_id) {
                    $.ajax({
                        url: "{{ route('doctors') }}",
                        type: 'GET',
                        data: {id: specialty_id},
                        dataType: 'JSON',
                        success: function (data) {
                            $('select[name="doctor_id"]').empty()
                            $.each(data, function (key, value) {
                                $('select[name="doctor_id"]').append(`<option value="${key}">${value}</option>`);
                            });
                        }
                    })
                } else {
                    console.log('Ajax Load Failed');
                }
            });
        });

        // This for days
        $(document).ready(function () {
            $('select[name="doctor_id"]').on('click', function () {
                let doctor_id = $(this).val();
                if (doctor_id) {
                    $.ajax({
                        url: "{{ route('days') }}",
                        type: 'GET',
                        data: {id: doctor_id},
                        dataType: 'JSON',
                        success: function (data) {
                            $('select[name="day_id"]').empty()
                            $.each(data, function (key, value) {
                                $('select[name="day_id"]').append(`<option value="${key}">${value}</option>`)
                            })
                        }
                    });
                } else {
                    console.log('Ajax Load Failed');
                }
            });
        });
    </script>
@endpush
