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
                        <span style="display: block;margin-bottom:10px">@lang('main.doctors') : <small>( {{ $doctors->total() }} )</small></span>
                        <form action="{{ route('dashboard.doctors.index') }}" method="get">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control" value="{{ request()->search }}"
                                           placeholder="@lang('main.search')">
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary btn-sm" title="@lang('main.search')">
                                        <i class="fa fa-search"></i></button>
                                    <a class="btn btn-danger btn-sm" href="{{ route('dashboard.doctors.index') }}"
                                       title="@lang('main.clear')">
                                        <i class="fa fa-eraser"></i></a>
                                    @if(auth()->user()->hasPermissionTo('doctor-create'))
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
                        @if($doctors->count() > 0)
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
                                    @foreach ($doctors as $index => $doctor)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $doctor->name }}</td>
                                            <td>{{ $doctor->specialty->name }}</td>
                                            <td>{{ $doctor->gender }}</td>
                                            <td>{{ $doctor->phone }}</td>

                                            <td>
                                                @if(auth()->user()->hasPermissionTo('doctor-edit'))
                                                    <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                       data-toggle="modal" href="#edit{{$doctor->id}}" title="@lang('main.edit')">
                                                        <i class="las la-pen"></i></a>
                                                @else
                                                    <a class="btn btn-sm btn-info disabled"
                                                       title="@lang('main.edit')"><i class="las la-pen"></i></a>
                                                @endif

                                                @if(auth()->user()->hasPermissionTo('doctor-delete'))
                                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                       data-toggle="modal" href="#delete{{$doctor->id}}" title="@lang('main.delete')">
                                                        <i class="las la-trash"></i></a>
                                                @endif

                                                @if(auth()->user()->hasPermissionTo('doctor-show'))
                                                    <a class="btn btn-sm btn-secondary" href="{{ route('dashboard.doctors.show',$doctor->id) }}"
                                                       title="@lang('main.show')">
                                                        <i class="las la-eye"></i></a>
                                                @endif
                                            </td>
                                        </tr>

                                        <!-- Edit -->
                                        <div class="modal" id="edit{{$doctor->id}}">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">@lang('main.edit')</h6>
                                                        <button aria-label="Close" class="close"
                                                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('dashboard.doctors.update', $doctor->id) }}" method="post" enctype="multipart/form-data">
                                                        {{ method_field('patch') }}
                                                        {{ csrf_field() }}

                                                        <div class="modal-body">
                                                            <div class="row mb-2">
                                                                <div class="col">
                                                                    <label for="name">{{ trans('main.doctor_name_ar') }}</label>
                                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $doctor->getTranslation('name','ar') }}" required>
                                                                </div>
                                                                <div class="col">
                                                                    <label for="name_en">{{ trans('main.doctor_name_en') }}</label>
                                                                    <input type="text" class="form-control" id="name_en" name="name_en" value="{{ $doctor->getTranslation('name','en') }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col">
                                                                    <label for="gender">{{ trans('main.gender') }}</label>
                                                                    <select class="form-control" id="gender" name="gender" required>
                                                                        <option value="">@lang('main.choose_gender')</option>
                                                                        <option value="male" {{ $doctor->gender === 'male' ? 'selected':'' }}>@lang('main.male')</option>
                                                                        <option value="female" {{ $doctor->gender === 'female' ? 'selected':'' }}>@lang('main.female')</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col">
                                                                    <label for="specialty">{{ trans('main.specialties') }}</label>
                                                                    <select class="form-control" id="specialty" name="specialty_id" required>
                                                                        <option value="">@lang('main.choose_specialty')</option>
                                                                        @foreach($specialties as $specialty)
                                                                            <option value="{{ $specialty->id }}" {{ $doctor->specialty_id === $specialty->id ? 'selected':'' }}>
                                                                                {{ $specialty->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col">
                                                                    <label for="phone">{{ trans('main.phone') }}</label>
                                                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $doctor->phone }}" required>
                                                                </div>
                                                                <div class="col">
                                                                    <label for="email">{{ trans('main.email') }}</label>
                                                                    <input type="email" class="form-control" id="email" name="email" value="{{ $doctor->email }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="image">@lang('main.image')</label>
                                                                <input type="file" name="image" id="image"
                                                                       class="form-control doctor_image">
                                                                @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <img class="img-responsive image_preview" style="width:60px"
                                                                     alt="@lang('main.image')"
                                                                     src="{{ $doctor->image_path }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="address">{{ trans('main.address') }}</label>
                                                                <textarea class="form-control" id="address" name="address" rows="3">{{ $doctor->address }}</textarea>
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
                                        <div class="modal" id="delete{{$doctor->id}}">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">@lang('main.delete')</h6>
                                                        <button aria-label="Close" class="close"
                                                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('dashboard.doctors.destroy', $doctor->id) }}" method="post">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}

                                                        <div class="modal-body">
                                                            <p>@lang('main.delete_msg')</p><br>
                                                            <input type="hidden" name="id" id="id" value="{{$doctor->id}}">
                                                            <input class="form-control" name="name" id="name"
                                                                   value="{{ $doctor->name }}" type="text" readonly>
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
        <!--/div-->
    </div>


    <!-- Add -->
    <div class="modal" id="add">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">@lang('main.add')</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('dashboard.doctors.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col">
                                <label for="name">{{ trans('main.doctor_name_ar') }}</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="col">
                                <label for="name_en">{{ trans('main.doctor_name_en') }}</label>
                                <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en') }}" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="gender">{{ trans('main.gender') }}</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="">@lang('main.choose_gender')</option>
                                    <option value="male">@lang('main.male')</option>
                                    <option value="female">@lang('main.female')</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="specialty">{{ trans('main.specialties') }}</label>
                                <select class="form-control" id="specialty" name="specialty_id" required>
                                    <option value="">@lang('main.choose_specialty')</option>
                                    @foreach($specialties as $specialty)
                                        <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="phone">{{ trans('main.phone') }}</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                            </div>
                            <div class="col">
                                <label for="email">{{ trans('main.email') }}</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">@lang('main.image')</label>
                            <input type="file" name="image" id="image"
                                   class="form-control doctor_image">
                            @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <img class="img-responsive image_preview" style="width:60px"
                                 alt="@lang('main.image')"
                                 src="{{ asset('uploads/doctors_images/default.png') }}">
                        </div>
                        <div class="form-group">
                            <label for="address">{{ trans('main.address') }}</label>
                            <textarea class="form-control" id="address" name="address" rows="3">{{ old('address') }}</textarea>
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
    <!-- End Add -->

@endsection
@push('js')
    <!--Internal  Notify js -->
    <script src="{{ asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/notify/js/notifit-custom.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ asset('dashboard/js/modal.js') }}"></script>
    <script type="text/javascript">
        $('.doctor_image').change(function () {
            if (this.files && this.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $('.image_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
@endpush
