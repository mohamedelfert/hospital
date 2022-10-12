@extends('front.layouts.app')

{{--@section('title')--}}
{{--    Title Here--}}
{{--@endsection--}}
@push('css')
@endpush

@section('content')

    <!-- Content Start -->
    <div class="container-fluid my-5 py-5">
        <div class="text-center mx-auto mb-5" style="max-width: 500px;">
            <h6 class="display-4 text-secondary text-uppercase border-bottom border-5">@lang('main.schedule')</h6>
        </div>
        @foreach ($specialties as $specialty)
            <div class="container-fluid banner mb-5">
                <div class="container">
                    <div class="row gx-0">
                        <div class="col-lg-12">
                            <div class="bg-primary d-flex flex-column p-5">
                                <h3 class="text-dark mb-3 text-center">{{ $specialty->name }}</h3>
                                @foreach ($specialty->doctors as $doctor)
                                    <div class="bg-secondary text-white mb-2 p-2">
                                        <h3 class="text-white mb-3 text-center">
                                            {{ LaravelLocalization::getCurrentLocale() === 'ar' ? 'د: '.$doctor->name : 'Dr: '.$doctor->name }}
                                        </h3>
                                        @foreach ($doctor->workdays as $workday)
                                            <div class="d-flex justify-content-between bg-dark text-white mb-2 p-2">
                                                <h6 class="text-white mb-0">{{ $workday->day }}</h6>
                                                <p class="mb-0">{{ \Carbon\Carbon::parse($workday->from_time)->format('g:i A') }}</p>
                                                <p class="mb-0">{{ \Carbon\Carbon::parse($workday->to_time)->format('g:i A') }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-12 text-center">
            {!! $specialties->links() !!}
        </div>
    </div>
    <!-- Content End -->

@endsection
@push('js')
@endpush
