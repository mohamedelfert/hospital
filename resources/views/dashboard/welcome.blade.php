@extends('dashboard.layouts.app')

@section('title')
    {{ $title }}
@endsection
@push('css')
    <!--  Owl-carousel css-->
    <link href="{{ asset('dashboard/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ asset('dashboard/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endpush

@section('content')

    <div class="content-wrapper">

        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">@lang('main.welcome')</h2>
                </div>
            </div>
            <div class="main-dashboard-header-right">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="default-color">@lang('main.dashboard')</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-lg-6 col-xl-3">
                <div class="card card-img-holder">
                    <div class="card-body list-icons">
                        <div class="clearfix">
                            <div class="float-right  mt-2">
                                <span class="text-primary ">
                                    <i class="si si-menu tx-30"></i>
                                </span>
                            </div>
                            <div class="float-left text-right">
                                <p class="card-text text-muted mb-1">@lang('main.specialties')</p>
                                <h3>{{ \App\Models\Specialty::count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6 col-xl-3">
                <div class="card card-img-holder">
                    <div class="card-body list-icons">
                        <div class="clearfix">
                            <div class="float-right  mt-2">
                                <span class="text-primary ">
                                    <i class="si si-user tx-30"></i>
                                </span>
                            </div>
                            <div class="float-left">
                                <p class="card-text text-muted mb-1">@lang('main.doctors')</p>
                                <h3>{{ \App\Models\Doctor::count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6 col-xl-3">
                <div class="card card-img-holder">
                    <div class="card-body list-icons">
                        <div class="clearfix">
                            <div class="float-right  mt-2">
                                <span class="text-primary">
                                    <i class="si si-calendar tx-30"></i>
                                </span>
                            </div>
                            <div class="float-left">
                                <p class="card-text text-muted mb-1">@lang('main.reservations')</p>
                                <h3>{{ \App\Models\Reservation::count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6 col-xl-3">
                <div class="card card-img-holder">
                    <div class="card-body list-icons">
                        <div class="clearfix">
                            <div class="float-right  mt-2">
                                <span class="text-primary">
                                    <i class="si si-people tx-30"></i>
                                </span>
                            </div>
                            <div class="float-left">
                                <p class="card-text text-muted mb-1">@lang('main.users')</p>
                                <h3>{{ \App\Models\User::count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-30">
                <div class="card card-statistics">
                    <div class="box-header with-border pt-3 pl-3 pr-3">
                        <h5>@lang('main.last_reservations')</h5>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive hoverable-table">
                            @if($reservations->count() > 0)
                                <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">#</th>
                                            <th class="border-bottom-0">@lang('main.patient_name')</th>
                                            <th class="border-bottom-0">@lang('main.phone')</th>
                                            <th class="border-bottom-0">@lang('main.specialty')</th>
                                            <th class="border-bottom-0">@lang('main.day')</th>
                                            <th class="border-bottom-0">@lang('main.examination')</th>
                                            <th class="border-bottom-0">@lang('main.status')</th>
                                            <th class="border-bottom-0">@lang('main.show')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($reservations as $index => $reservation)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $reservation->name }}</td>
                                            <td>{{ $reservation->phone }}</td>
                                            <td>{{ $reservation->specialty->name }}</td>
                                            <td>{{ $reservation->day->day }}</td>
                                            <td>{{ $reservation->examination->name }}</td>
                                            <td>
                                                @if($reservation->is_completed === 0)
                                                    <a href="complete/{{$reservation->id}}">
                                                        <span class="badge badge-pill badge-danger">@lang('main.complete')</span>
                                                    </a>
                                                @elseif($reservation->is_completed === 1)
                                                    <span class="badge badge-pill badge-success">@lang('main.completed')</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if(auth()->user()->hasPermissionTo('reservation-show'))
                                                    <a class="btn btn-sm btn-secondary" href="{{ route('dashboard.reservations.show',$reservation->id) }}"
                                                       title="@lang('main.show')">
                                                        <i class="las la-eye"></i></a>
                                                @endif
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">#</th>
                                            <th class="border-bottom-0">@lang('main.patient_name')</th>
                                            <th class="border-bottom-0">@lang('main.phone')</th>
                                            <th class="border-bottom-0">@lang('main.specialty')</th>
                                            <th class="border-bottom-0">@lang('main.day')</th>
                                            <th class="border-bottom-0">@lang('main.examination')</th>
                                            <th class="border-bottom-0">@lang('main.control')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="7" class="text-center text-danger">@lang('main.no_data_found')</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-30">
                <div class="card card-statistics">
                    <div class="box-header with-border pt-3 pl-3 pr-3">
                        <h5>@lang('main.last_doctors')</h5>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive hoverable-table">
                            @if($doctors->count() > 0)
                                <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                                    <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">@lang('main.name')</th>
                                        <th class="border-bottom-0">@lang('main.specialty')</th>
                                        <th class="border-bottom-0">@lang('main.gender')</th>
                                        <th class="border-bottom-0">@lang('main.phone')</th>
                                        <th class="border-bottom-0">@lang('main.show')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($doctors as $index => $doctor)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $doctor->name }}</td>
                                            <td>{{ $doctor->specialty->name }}</td>
                                            <td>{{ $doctor->gender }}</td>
                                            <td>{{ $doctor->phone }}</td>

                                            <td>
                                                @if(auth()->user()->hasPermissionTo('doctor-show'))
                                                    <a class="btn btn-sm btn-secondary" href="{{ route('dashboard.doctors.show',$doctor->id) }}"
                                                       title="@lang('main.show')">
                                                        <i class="las la-eye"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                                    <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">@lang('main.name')</th>
                                        <th class="border-bottom-0">@lang('main.specialty')</th>
                                        <th class="border-bottom-0">@lang('main.gender')</th>
                                        <th class="border-bottom-0">@lang('main.phone')</th>
                                        <th class="border-bottom-0">@lang('main.control')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="6" class="text-center text-danger">@lang('main.no_data_found')</td>
                                    </tr>
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-sm">
            <div class="col-md-12 col-lg-12 col-xl-7">
                <div class="card">
                    <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-0">Title Here</h4>
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                        <p class="tx-12 text-muted mb-0">Order Status and Tracking. Track your order from ship date to arrival. To begin, enter your order number.</p>
                    </div>
                    <div class="card-body">
                        Text Here
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-5">
                <div class="card card-dashboard-map-one">
                    <label class="main-content-label">Title Here</label>
                    <span class="d-block mg-b-20 text-muted tx-12">Sales Performance of all states in the United States</span>
                    <div class="">
                        Text Here
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@push('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ asset('dashboard/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ asset('dashboard/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ asset('dashboard/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('dashboard/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ asset('dashboard/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ asset('dashboard/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ asset('dashboard/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('dashboard/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ asset('dashboard/js/index.js') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.vmap.sampledata.js') }}"></script>
@endpush
