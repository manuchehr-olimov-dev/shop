<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', env("APP_NAME"))</title>
    @vite(['resources/css/app.css', 'resources/sass/main.sass', 'resources/js/app.js'])
</head>
<body class="antialiased">

        @include('shared.flash')
        @include('shared.header')

        @yield('content')

        @include('shared.footer')
</body>

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</html>
