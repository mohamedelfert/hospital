@extends('dashboard.layouts.app')
@section('title')
    {{$title}}
@stop
@push('css')
    <!--Internal   Notify -->
    <link href="{{ asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet"/>
    <style>
        @media print {
            #reservation_print {
                display: none
            }
        }
    </style>
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
                    <div class="main-contact-info-body p-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="main-content-body-invoice" id="print">
                                    <div class="">
                                        <div class="billed-from">
                                            <h6>{{ LaravelLocalization::getCurrentLocale() === 'ar' ? setting()->site_name_ar:setting()->site_name_en }}</h6>
                                            <p>
                                                @lang('main.phone') : {{ setting()->phone }}<br>
                                                @lang('main.email') : {{ setting()->email }}
                                            </p>
                                        </div>
                                    </div>

                                    <hr style="border: 1px solid #d9dbe0">

                                    <div class="row mg-t-20">
                                        <div class="col-md">
                                            <label class="tx-gray-600">@lang('main.bill_to')</label>
                                            <div class="billed-to">
                                                <h6>@lang('main.name') : {{ $reservation->name }}</h6>
                                                <p>@lang('main.address') : {{ $reservation->address }}</p>
                                                <p>@lang('main.phone') : <span> {{ $reservation->phone }} </span></p>
                                            </div>
                                        </div>

                                        <div class="col-md">
                                            <label class="tx-gray-600">@lang('main.reservation_details')</label>
                                            <p class="invoice-info-row"><span>@lang('main.reservation_number') :</span>
                                                <span>{{ $reservation->id }}</span></p>
                                            <p class="invoice-info-row"><span>@lang('main.reservation_date') :</span>
                                                <span>{{ $reservation->day->day }} | {{ $reservation->date }}</span></p>
                                            <p class="invoice-info-row"><span>@lang('main.doctor') :</span>
                                                <span>{{ $reservation->doctor->name }}</span></p>
                                            <p class="invoice-info-row"><span>@lang('main.specialty') :</span>
                                                <span>{{ $reservation->specialty->name }}</span></p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="table-responsive mg-t-40">
                                        <table class="table table-invoice border text-md-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="wd-20p">#</th>
                                                    <th class="wd-40p">@lang('main.description')</th>
                                                    <th class="tx-center">@lang('main.price')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $reservation->id }}</td>
                                                    <td class="tx-12">{{ $reservation->examination->name }}</td>
                                                    <td class="tx-center">{{ $reservation->price }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="valign-middle" colspan="1" rowspan="4">
                                                        <div class="order-notes">
                                                            <label class="main-content-label tx-13"></label>
                                                        </div>
                                                    <td class="tx-right font-weight-bold">@lang('main.discount')</td>
                                                    <td class="tx-right" colspan="2">EGP 00.00</td>
                                                </tr>
                                                <tr>
                                                    <td class="tx-right font-weight-bold">@lang('main.total')</td>
                                                    <td class="tx-right" colspan="2">
                                                        <h5 class="tx-bold">EGP {{ number_format($reservation->price, 2) }}</h5>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <hr class="mg-b-40">
                            <a href="#" class="btn btn-primary float-left mb-3 mr-2 ml-2" id="reservation_print"
                               onclick="printReservation()"><i class="fas fa-print ml-1"></i> @lang('main.print')
                            </a>
                        </div>
                    </div>
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
        function printReservation(){
            let content = document.getElementById('print').innerHTML;
            document.body.innerHTML = content;
            window.print();
            location.reload();
        }
    </script>
@endpush
