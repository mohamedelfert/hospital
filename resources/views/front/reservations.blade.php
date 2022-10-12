@extends('front.layouts.app')

{{--@section('title')--}}
{{--    Title Here--}}
{{--@endsection--}}
@push('css')
@endpush

@section('content')

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
