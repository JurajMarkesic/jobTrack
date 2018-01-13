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

</head>
<body style=" overflow-x: hidden;">

    <nav class="navbar navbar-expand-lg navbar-light bg-faded">
        <div class="container">
            @if (Route::has('login'))
            <a class="navbar-brand" href="{{ url('/') }}">
                <span class="h1">{{ config('app.name', 'Laravel') }}</span>
            </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            <div class="collapse navbar-collapse justify-content-end mt-3" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link h4">Dashboard</a></li>
                    @else
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link h4">Login</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link h4">Register</a></li>
                    @endauth
                </ul>
            </div>
            @endif
        </div>
    </nav>
    <div class="container mt-5">
    @auth
        <div class="jumbotron bg-primary text-white mb-5">
            <h1 class="display-3 mr-3">Welcome to {{ config('app.name', 'Laravel') }}!</h1>
            <p class="lead font-weight-bold">To manage your job search, you first need jobs to apply to. We offer 3 ways of adding job listings.</p>
            <p class="lead">You can track and edit your listings in your <a href="/home" class="text-white">Dashboard</a>.</p>
        </div>

        <div class="card-deck">
            <div class="card">
                <h1 class="card-img-top mb-3" style="font-size: 4rem;"><span class="px-3 pb-2 border-top-0 border-left-0"
                                                                             style="border: solid black 1px;">1</span></h1>
                <div class="card-block">
                    <h4 class="card-title"><a href="/jooble">&nbsp Jooble</a></h4>
                    <p class="card-text px-4 pb-3">
                        Through accessing Jooble's API you are able to apply to thousands of jobs in any sector.
                        This option also contains listings that offer relocation abroad.
                    </p>
                </div>
            </div>
            <div class="card">
                <h1 class="card-img-top mb-3" style="font-size: 4rem;"><span class="px-3 pb-2 border-top-0 border-left-0"
                                                                             style="border: solid black 1px;">2</span></h1>
                <div class="card-block">
                    <h4 class="card-title"><a href="/rss">&nbsp Posao.hr</a></h4>
                    <p class="card-text px-4 pb-3">Posao.hr offers a RSS feed that gives you access to a constantly growing pool of local jobs.
                        This is the biggest job site in Croatia.</p>
                </div>
            </div>
            <div class="card">
                <h1 class="card-img-top mb-3" style="font-size: 4rem;"><span class="px-3 pb-2 border-top-0 border-left-0"
                                                                             style="border: solid black 1px;">3</span></h1>
                <div class="card-block">
                    <h4 class="card-title"><a href="/home">&nbsp Custom listings</a></h4>
                    <p class="card-text px-4 pb-3">
                        Already know of an opening that isn't listed on these sites? You can add and track your own custom listing!
                    </p>
                </div>
            </div>
        </div>

    @else
        <div class="jumbotron bg-primary text-white mb-5">
            <h1 class="display-3">{{ config('app.name', 'Laravel') }}</h1>
            <h2>The only tool you need to manage your job search.</h2>
            <p class="lead">You should start by <a href="/register" class="text-white">Registering.</a> </p>
        </div>
    @endauth
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
