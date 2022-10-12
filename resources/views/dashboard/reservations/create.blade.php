@extends('dashboard.layouts.app')
@section('title')
    {{$title}}
@stop
@push('css')
    <!--Internal   Notify -->
    <link href="{{ asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet"/>
@endpush
@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger mt-5">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>@lang('main.error')</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{ $title }}</h2>
            </div>
        </div>
        <div class="main-dashboard-header-right">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}" class="default-color">@lang('main.dashboard')</a>
                </li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="box-header with-border">
                        <a class="btn btn-primary btn-sm" href="{{ route('dashboard.reservations.index') }}"
                           title="@lang('main.back')">
                            <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>

                <hr style="margin:10px 30px">

                <div class="card-body">
                    <form action="{{ route('dashboard.reservations.store') }}" method="post">
                        {{ csrf_field() }}

                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="name">{{ trans('main.patient_name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ old('name') }}" required>
                                </div>
                                <div class="col">
                                    <label for="gender">{{ trans('main.gender') }}</label>
                                    <select name="gender" id="gender" class="form-control" required>
                                        <option value="">@lang('main.choose_gender')</option>
                                        <option value="male">{{ trans('main.male') }}</option>
                                        <option value="female">{{ trans('main.female') }}</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="age">{{ trans('main.age') }}</label>
                                    <input type="number" class="form-control" min="0" max="120" step="0.1" id="age"
                                           name="age" value="{{ old('age') }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="phone">{{ trans('main.phone') }}</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                           value="{{ old('phone') }}" required>
                                </div>
                                <div class="col">
                                    <label for="address">{{ trans('main.address') }}</label>
                                    <textarea class="form-control" id="address" name="address"
                                              rows="3">{{ old('address') }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="examination">@lang('main.examinations')</label>
                                    <select name="examination_id" id="examination" class="form-control" required>
                                        <option value="">@lang('main.choose_examination')</option>
                                        @foreach($examinations as $examination)
                                            <option value="{{ $examination->id }}">{{ $examination->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="specialty">@lang('main.specialties')</label>
                                    <select name="specialty_id" id="specialty" class="form-control" required>
                                        <option value="">@lang('main.choose_specialty')</option>
                                        @foreach($specialties as $specialty)
                                            <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="doctor">@lang('main.doctor')</label>
                                    <select name="doctor_id" id="doctor" class="form-control" required>
                                        <option value="">@lang('main.choose_doctor')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="day">{{ trans('main.days') }}</label>
                                    <select name="day_id" id="day" class="form-control" required>
                                        <option value="">@lang('main.choose_day')</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="date">{{ trans('main.date') }}</label>
                                    <input class="form-control fc-datepicker" type="date" id="date" name="date" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">{{ trans('main.confirm') }}</button>
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('main.close') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <!--Internal  Notify js -->
    <script src="{{ asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/notify/js/notifit-custom.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ asset('dashboard/js/modal.js') }}"></script>
    <script>
        // This for doctors name
        $(document).ready(function () {
            $('select[name="specialty_id"]').on('change', function () {
                let specialty_id = $(this).val();
                if (specialty_id) {
                    $.ajax({
                        url: "{{ route('dashboard.doctor') }}",
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
                        url: "{{ route('dashboard.day') }}",
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
