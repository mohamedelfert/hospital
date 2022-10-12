@extends('front.layouts.app')

{{--@section('title')--}}
{{--    Title Here--}}
{{--@endsection--}}
@push('css')
@endpush

@section('content')

    <!-- Search Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Find A Doctor</h5>
                <h1 class="display-4 mb-4">Find A Healthcare Professionals</h1>
                <h5 class="fw-normal">Find A Healthcare Professionals</h5>
            </div>
            <div class="mx-auto" style="width: 100%; max-width: 600px;">
                <form method="POST" action="{{ route('search') }}">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <select name="specialty_id" class="form-select border-primary w-25" style="height: 60px;">
                            <option value="">@lang('main.choose_specialty')</option>
                            @foreach($specialties as $specialty)
                                <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="keyword" class="form-control border-primary w-50" placeholder="Keyword">
                        <button class="btn btn-dark border-0 w-25" type="submit">@lang('main.search')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Search End -->

    <!-- Search Result Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                @foreach($doctors as $doctor)
                    <div class="col-lg-6 team-item">
                    <div class="row g-0 bg-light rounded overflow-hidden">
                        <div class="col-12 col-sm-5 h-100">
                            <img class="img-fluid h-100" src="{{ $doctor->image_path }}" style="object-fit: cover;">
                        </div>
                        <div class="col-12 col-sm-7 h-100 d-flex flex-column">
                            <div class="mt-auto p-4">
                                <h3>{{ $doctor->name }}</h3>
                                <h6 class="fw-normal fst-italic text-primary mb-4">{{ $doctor->specialty->name }}</h6>
                                <p class="m-0">{{ $doctor->address }}</p>
                            </div>
                            <div class="d-flex mt-auto border-top p-4">
                                <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-3" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-3" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-lg btn-primary btn-lg-square rounded-circle" href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="col-12 text-center">
                    {!! $doctors->links() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- Search Result End -->

@endsection
@push('js')
@endpush
