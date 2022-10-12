<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">
{{--<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">--}}

    <head>
        <meta charset="utf-8">
        <title>{{ LaravelLocalization::getCurrentLocale() === 'ar' ? setting()->site_name_ar:setting()->site_name_en }}</title>
{{--        <title> @yield('title') </title>--}}
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Alataa Health Center" name="keywords">
        <meta content="Alataa Health Center" name="description">

        <!-- Favicon -->
        <link href="{{ setting()->icon_path }}" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{ asset('front/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">

    {{--        @if (app()->getLocale() == 'ar')--}}
    {{--            <!-- Sidemenu css -->--}}
    {{--                <link rel="stylesheet" href="{{URL::asset('dashboard/css-rtl/sidemenu.css')}}">--}}
    {{--                <!--- Style css -->--}}
    {{--                <link href="{{URL::asset('dashboard/css-rtl/style.css')}}" rel="stylesheet">--}}
    {{--                <!--- Dark-mode css -->--}}
    {{--                <link href="{{URL::asset('dashboard/css-rtl/style-dark.css')}}" rel="stylesheet">--}}
    {{--                <!---Skinmodes css-->--}}
    {{--                <link href="{{URL::asset('dashboard/css-rtl/skin-modes.css')}}" rel="stylesheet">--}}
    {{--                <style>--}}
    {{--                    body, h1, h2, h3, h4, h5, h6 {--}}
    {{--                        font-family: 'Cairo', sans-serif !important;--}}
    {{--                    }--}}
    {{--                </style>--}}
    {{--        @else--}}
    {{--            <!-- Sidemenu css -->--}}
    {{--                <link rel="stylesheet" href="{{URL::asset('dashboard/css/sidemenu.css')}}">--}}
    {{--                <!--- Style css -->--}}
    {{--                <link href="{{URL::asset('dashboard/css/style.css')}}" rel="stylesheet">--}}
    {{--                <!--- Dark-mode css -->--}}
    {{--                <link href="{{URL::asset('dashboard/css/style-dark.css')}}" rel="stylesheet">--}}
    {{--                <!---Skinmodes css-->--}}
    {{--                <link href="{{URL::asset('dashboard/css/skin-modes.css')}}" rel="stylesheet">--}}
    {{--        @endif--}}

    <!-- Template Stylesheet -->

        <link href="{{ asset('front/css/style.css') }}" rel="stylesheet">

        @toastr_css
        @stack('css')
    </head>

    <body>
