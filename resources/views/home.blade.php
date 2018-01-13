@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="jumbotron bg-danger text-white mb-5">
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

    </div>
@endsection