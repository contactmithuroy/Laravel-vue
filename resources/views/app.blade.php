<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel-Vue</title>
        <link rel="icon" href="{{ asset('images') }}/front/favicon.ico" type="image/x-icon">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    </head> 
    <body class="">
        <div id="app">
            <app-header class="mb-4"></app-header>
            <router-view></router-view>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
