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

    <div class="container-fluid">
        <nav class="navbar">
            <p class="invisible">secret memes</p>
           <ul class="navbar-nav justify-content-end">
              <li> <a href="/login"><span class="mt-3" id="navLoginBtn">Login</span></a></li>
           </ul>
        </nav>
        <div style="text-align: center;">
            <div style="margin-top: 10%;" id="titleWrap">
                <img src="/images/mg1.png" alt="question mark" style="height: 7rem; margin-top: -5%;">
                <h1>jobTrack</h1>
            </div>
            <h3>Extensive job searching tool.</h3>
            <button class="col-8 col-md-4 col-lg-3 col-xl-2" id="registerButton" style="font-size: 1.2rem;"><a href="/register" style="color: white; text-underline: none;">Register to start</a></button>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
