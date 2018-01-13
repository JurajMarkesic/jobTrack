<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">


    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
</head>
<body style=" overflow-x: hidden;">

    {{--<nav class="navbar navbar-expand-lg navbar-light bg-faded">--}}
        {{--<div class="container">--}}
            {{--@if (Route::has('login'))--}}
            {{--<a class="navbar-brand" href="{{ url('/') }}">--}}
                {{--<span class="h1">{{ config('app.name', 'Laravel') }}</span>--}}
            {{--</a>--}}
                {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"--}}
                        {{--aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
                    {{--<span class="navbar-toggler-icon"></span>--}}
                {{--</button>--}}

            {{--<div class="collapse navbar-collapse justify-content-end mt-3" id="navbarSupportedContent">--}}
                {{--<ul class="navbar-nav">--}}
                    {{--@auth--}}
                        {{--<li class="nav-item"><a href="{{ url('/home') }}" class="nav-link h4">Dashboard</a></li>--}}
                    {{--@else--}}
                        {{--<li class="nav-item"><a href="{{ route('login') }}" class="nav-link h4">Login</a></li>--}}
                        {{--<li class="nav-item"><a href="{{ route('register') }}" class="nav-link h4">Register</a></li>--}}
                    {{--@endauth--}}
                {{--</ul>--}}
            {{--</div>--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--</nav>--}}
    {{--<div class="container mt-5">--}}


    <ul class="container-fluid">
        <nav class="navbar">
            <p class="invisible">secret memes</p>
           <ul class="navbar-nav justify-content-end">
               <a href="/login"><span class="btn  mt-3" id="navLogin">Login</span></a>
           </ul>
        </nav>
        <center>
            <h1>laravel</h1>
            <h3>Extensive job searching tool.</h3>
            <button class="btn col-6 col-md-2" id="registerButton" style="font-size: 1.2rem;"><a href="/register" style="color: white;">Register to start</a></button>
        </center>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
