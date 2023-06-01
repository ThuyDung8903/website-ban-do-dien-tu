<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keywords')">
    <meta name="author" content="Shop Thuy Dung">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    {{-- Bootstrap 5.1 CSS --}}
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    {{--    CSS Owl Carousel--}}
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">

    {{-- Exzoom CSS Product Image--}}
    <link rel="stylesheet" href="{{ asset('assets/exzoom/jquery.exzoom.css') }}">

    <!-- CSS Alertifyjs-->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>

    @livewireStyles
</head>

<body>
<div id="app">
    @include('layouts.inc.frontend.navbar')
    <main class="py-4">
        @yield('content')
    </main>
    @include('layouts.inc.frontend.footer')
</div>

{{-- Bootstrap 5.1 JavaScript --}}
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="{{ asset('assets/js/jquery-3.6.4.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- JavaScript for https://alertifyjs.com/guide.html -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script>
    window.addEventListener('message', event => {
        if (event.detail) {
            alertify.set('notifier', 'position', 'top-right');
            alertify.notify(event.detail.message, event.detail.type);
        }
    });
</script>

{{--    JavaScript Owl Carousel--}}
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
{{--    JavaScript Exzoom Product Image--}}
<script src="{{asset('assets/exzoom/jquery.exzoom.js')}}"></script>

@yield('script')

@livewireScripts
@stack('scripts')
</body>

</html>
