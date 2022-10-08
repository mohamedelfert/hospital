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
                        <span style="display: block;margin-bottom:10px">@lang('main.prices') : <small>( {{ $prices->total() }} )</small></span>
                        <form action="{{ route('dashboard.prices.index') }}" method="get">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control" value="{{ request()->search }}"
                                           placeholder="@lang('main.search')">
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary btn-sm" title="@lang('main.search')">
                                        <i class="fa fa-search"></i></button>
                                    <a class="btn btn-danger btn-sm" href="{{ route('dashboard.prices.index') }}"
                                       title="@lang('main.clear')">
                                        <i class="fa fa-eraser"></i></a>
                                    @if(auth()->user()->hasPermissionTo('price-create'))
                                        <a class="modal-effect btn btn-primary btn-sm" data-effect="effect-scale"
                                           data-toggle="modal" href="#add"title="@lang('main.create')">
                                            <i class="fa fa-plus"></i>
                                        </a>
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
                        @if($prices->count() > 0)
                            <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">@lang('main.specialty')</th>
                                        <th class="border-bottom-0">@lang('main.examination')</th>
                                        <th class="border-bottom-0">@lang('main.price')</th>
                                        <th class="border-bottom-0">@lang('main.control')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prices as $index => $price)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $price->specialty->name }}</td>
                                            <td>{{ $price->examination->name }}</td>
                                            <td>{{ $price->price }} EGP</td>

                                            <td>
                                                @if(auth()->user()->hasPermissionTo('price-edit'))
                                                    <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                       data-toggle="modal" href="#edit{{$price->id}}" title="@lang('main.edit')">
                                                        <i class="las la-pen"></i></a>
                                                @else
                                                    <a class="btn btn-sm btn-info disabled"
                                                       title="@lang('main.edit')"><i class="las la-pen"></i></a>
                                                @endif

                                                @if(auth()->user()->hasPermissionTo('price-delete'))
                                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                       data-toggle="modal" href="#delete{{$price->id}}" title="@lang('main.delete')">
                                                        <i class="las la-trash"></i></a>
                                                @endif
                                            </td>
                                        </tr>

                                        <!-- Edit -->
                                        <div class="modal" id="edit{{$price->id}}">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">@lang('main.edit')</h6>
                                                        <button aria-label="Close" class="close"
                                                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('dashboard.prices.update', $price->id) }}" method="post">
                                                        {{ method_field('patch') }}
                                                        {{ csrf_field() }}

                                                        <div class="modal-body">
                                                            <div class="row mb-3">
                                                                <div class="col form-group">
                                                                    <label for="specialty">@lang('main.specialties')</label>
                                                                    <select name="specialty_id" id="specialty" class="form-control">
                                                                        <option value="">@lang('main.choose_specialty')</option>
                                                                        @foreach($specialties as $specialty)
                                                                            <option value="{{ $specialty->id }}" {{ $price->specialty_id === $specialty->id ? 'selected':'' }}>
                                                                                {{ $specialty->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col form-group">
                                                                    <label for="examination">@lang('main.examinations')</label>
                                                                    <select name="examination_id" id="examination" class="form-control">
                                                                        <option value="">@lang('main.choose_examination')</option>
                                                                        @foreach($examinations as $examination)
                                                                            <option value="{{ $examination->id }}" {{ $price->examination_id === $examination->id ? 'selected':'' }}>
                                                                                {{ $examination->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col form-group">
                                                                    <label for="price">@lang('main.price')</label>
                                                                    <input type="number" class="form-control" min="0" max="1000" step="0.1" id="price" name="price" value="{{ $price->price }}">
                                                                </div>
                                                            </div>
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
                                        <!-- End Edit -->

                                        <!-- Delete -->
                                        <div class="modal" id="delete{{$price->id}}">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">@lang('main.delete')</h6>
                                                        <button aria-label="Close" class="close"
                                                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('dashboard.prices.destroy', $price->id) }}" method="post">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}

                                                        <div class="modal-body">
                                                            <p>@lang('main.delete_msg')</p><br>
                                                            <input type="hidden" name="id" id="id" value="{{$price->id}}">
                                                            <input class="form-control" name="day" id="day"
                                                                   value="{{ $price->specialty->name }}" type="text" readonly><br>
                                                            <input class="form-control" name="day" id="day"
                                                                   value="{{ $price->examination->name }}" type="text" readonly><br>
                                                            <input class="form-control" name="day" id="day"
                                                                   value="{{ $price->price }}" type="text" readonly>
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
                                        <th class="border-bottom-0">@lang('main.specialty')</th>
                                        <th class="border-bottom-0">@lang('main.examination')</th>
                                        <th class="border-bottom-0">@lang('main.price')</th>
                                        <th class="border-bottom-0">@lang('main.control')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="5" class="text-center text-danger">@lang('main.no_data_found')</td>
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


    <!--- Add --->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('main.add')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('dashboard.prices.store') }}" method="post" class="form repeater-default">
                    {{ csrf_field() }}

                    <div class="modal-body">
                        <div data-repeater-list="prices_list">
                            <div data-repeater-item>
                                <div class="row">
                                    <div class="col form-group">
                                        <label for="specialty">@lang('main.specialties')</label>
                                        <select name="specialty_id" id="specialty" class="form-control">
                                            <option value="">@lang('main.choose_specialty')</option>
                                            @foreach($specialties as $specialty)
                                                <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col form-group">
                                        <label for="examination">@lang('main.examinations')</label>
                                        <select name="examination_id" id="examination" class="form-control">
                                            <option value="">@lang('main.choose_examination')</option>
                                            @foreach($examinations as $examination)
                                                <option value="{{ $examination->id }}">{{ $examination->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col form-group">
                                        <label for="price">@lang('main.price')</label>
                                        <input type="number" class="form-control" min="0" max="1000" step="0.1" id="price" name="price" value="{{ old('price') }}">
                                    </div>
                                    <div class="col-md-2 col-sm-12 form-group d-flex align-items-center mt-4">
                                        <button class="btn btn-danger" data-repeater-delete type="button">
                                            <i class="bx bx-x"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col p-0">
                                <button class="btn btn-primary" data-repeater-create type="button">
                                    <i class="bx bx-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ trans('main.confirm') }}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('main.close') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!--- End Add --->

@endsection
@push('js')
    <!--Internal  Notify js -->
    <script src="{{ asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/notify/js/notifit-custom.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ asset('dashboard/js/modal.js') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.repeater.js') }}"></script>

    <!-- form repeater Initialization -->
    <script>
        $('.repeater-default').repeater({
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    </script>
@endpush
