<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/admin.css') }}" rel="stylesheet">
    @yield('css-script')
</head>
<body>
    <div id="app">
        @include ('layouts.parts.admin-nav')

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="{{ flash()->class }} alert-dismissible fade show">
                            {{ flash()->message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')
        </main>
    </div>

    <div class="clearfix"></div>

    <!-- Scripts -->
    <script src="{{ mix('js/admin.js') }}"></script>
    @yield('js-script')

    @include ('layouts.parts.admin-footer')
</body>
</html>
