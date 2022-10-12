@extends('front.layouts.app')

{{--@section('title')--}}
{{--    Title Here--}}
{{--@endsection--}}
@push('css')
@endpush

@section('content')

        <!-- Content Start -->
        <div class="container-fluid bg-primary my-5 py-5">
            <div class="container">
                <div class="text-center text-danger" style="margin: 20% auto">
                    <h1>We&rsquo;ll be back soon!</h1>
                    <div>
                        <p class="badge badge-danger">{!! setting()->message_maintenance !!}</p>
                        <p>&mdash; The Team</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content End -->

@endsection
@push('js')
@endpush
