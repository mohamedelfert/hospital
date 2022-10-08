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
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab1" class="nav-link active" data-toggle="tab">@lang('main.doctor_information')</a></li>
                                            <li><a href="#tab2" class="nav-link" data-toggle="tab">@lang('main.schedule')</a></li>
                                            <li><a href="#tab3" class="nav-link" data-toggle="tab">@lang('main.examination_prices')</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab1">
                                            <div class="main-contact-info-body p-4">
                                                <div class="row">
                                                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-1">
                                                        <p class="text-muted">
                                                            <img class="img-fluid" src="{{ $doctor->image_path }}" alt="@lang('main.doctor')" style="width: 210px;height: 140px;">
                                                        </p>
                                                    </div>
                                                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-2">
                                                        <div class="media-list pb-0">
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <div>
                                                                    <label>@lang('main.name')</label> <span class="tx-medium text-primary">{{ $doctor->name }}</span>
                                                                </div>
                                                                <div>
                                                                    <label>@lang('main.specialty')</label> <span class="tx-medium text-primary">{{ $doctor->specialty->name }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <div>
                                                                    <label>@lang('main.phone')</label> <span class="tx-medium text-danger">{{ $doctor->phone }}</span>
                                                                </div>
                                                                <div>
                                                                    <label>@lang('main.email')</label> <span class="tx-medium text-info">{{ $doctor->email }}</span>
                                                                </div>
                                                                <div>
                                                                    <label>@lang('main.gender')</label>
                                                                    @if($doctor->gender === 'male')
                                                                        <span class="badge badge-pill badge-success" style="width: 25%">{{ $doctor->gender }}</span>
                                                                    @elseif($doctor->gender === 'female')
                                                                        <span class="badge badge-pill badge-danger" style="width: 25%">{{ $doctor->gender }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="media mb-0">
                                                            <div class="media-body">
                                                                <div>
                                                                    <label>@lang('main.address')</label> <span class="tx-medium text-dark">{{ $doctor->address }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab2">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table text-md-nowrap" id="example1">
                                                        <thead>
                                                            <tr>
                                                                <th class="wd-5p border-bottom-0">#</th>
                                                                <th class="wd-10p border-bottom-0">@lang('main.days')</th>
                                                                <th class="wd-10p border-bottom-0">@lang('main.last_edit')</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($doctor->workdays as $index => $workday)
                                                            <tr>
                                                                <th class="wd-5p border-bottom-0">{{ $index + 1 }}</th>
                                                                <th class="wd-10p border-bottom-0">{{ $workday->day }}</th>
                                                                <th class="wd-10p border-bottom-0">{{ $workday->updated_at }}</th>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab3">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table text-md-nowrap" id="example1">
                                                        <thead>
                                                            <tr>
                                                                <th class="wd-5p border-bottom-0">#</th>
                                                                <th class="wd-10p border-bottom-0">@lang('main.examination_type')</th>
                                                                <th class="wd-10p border-bottom-0">@lang('main.price')</th>
                                                                <th class="wd-10p border-bottom-0">@lang('main.last_edit')</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th class="wd-5p border-bottom-0">#</th>
                                                                <th class="wd-10p border-bottom-0">رقم الفاتوره</th>
                                                                <th class="wd-10p border-bottom-0">القسم</th>
                                                                <th class="wd-10p border-bottom-0">المنتج</th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>

@endsection
@push('js')
    <!--Internal  Notify js -->
    <script src="{{ asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/notify/js/notifit-custom.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ asset('dashboard/js/modal.js') }}"></script>
@endpush
