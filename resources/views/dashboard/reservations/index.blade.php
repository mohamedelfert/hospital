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
                        <span style="display: block;margin-bottom:10px">@lang('main.reservations') : <small>( {{ $reservations->total() }} )</small></span>
                        <form action="{{ route('dashboard.reservations.index') }}" method="get">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control" value="{{ request()->search }}"
                                           placeholder="@lang('main.search')">
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary btn-sm" title="@lang('main.search')">
                                        <i class="fa fa-search"></i></button>
                                    <a class="btn btn-danger btn-sm" href="{{ route('dashboard.reservations.index') }}"
                                       title="@lang('main.clear')">
                                        <i class="fa fa-eraser"></i></a>
                                    @if(auth()->user()->hasPermissionTo('reservation-create'))
                                        <a class="btn btn-sm btn-primary" href="{{ route('dashboard.reservations.create') }}"
                                           title="@lang('main.create')">
                                            <i class="las la-plus"></i></a>
                                    @else
                                        <a class="btn btn-primary btn-sm disabled" title="@lang('main.create')"><i class="fa fa-plus"></i></a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <hr style="margin:10px 30px">

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
                                        <th class="border-bottom-0">@lang('main.control')</th>
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
                                                @if(auth()->user()->hasPermissionTo('reservation-edit'))
                                                    <a class="btn btn-sm btn-info" href="{{ route('dashboard.reservations.edit',$reservation->id) }}"
                                                       title="@lang('main.edit')">
                                                        <i class="las la-pen"></i></a>
                                                @else
                                                    <a class="btn btn-sm btn-info disabled"
                                                       title="@lang('main.edit')"><i class="las la-pen"></i></a>
                                                @endif

                                                @if(auth()->user()->hasPermissionTo('reservation-delete'))
                                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                       data-toggle="modal" href="#delete{{$reservation->id}}" title="@lang('main.delete')">
                                                        <i class="las la-trash"></i></a>
                                                @endif

                                                @if(auth()->user()->hasPermissionTo('reservation-show'))
                                                    <a class="btn btn-sm btn-secondary" href="{{ route('dashboard.reservations.show',$reservation->id) }}"
                                                       title="@lang('main.show')">
                                                        <i class="las la-eye"></i></a>
                                                @endif
                                            </td>
                                        </tr>

                                        <!-- Delete -->
                                        <div class="modal" id="delete{{$reservation->id}}">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">@lang('main.delete')</h6>
                                                        <button aria-label="Close" class="close"
                                                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('dashboard.reservations.destroy', $reservation->id) }}" method="post">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}

                                                        <div class="modal-body">
                                                            <p>@lang('main.delete_msg')</p><br>
                                                            <input type="hidden" name="id" id="id" value="{{$reservation->id}}">
                                                            <input class="form-control" name="name" id="name"
                                                                   value="{{ $reservation->name }}" type="text" readonly><br>
                                                            <input class="form-control" name="examination" id="examination"
                                                                   value="{{ $reservation->examination->name }}" type="text" readonly>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">@lang('main.cancel')
                                                            </button>
                                                            <button type="submit" class="btn btn-danger">@lang('main.confirm')</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Delete -->

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
