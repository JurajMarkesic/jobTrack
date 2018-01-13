<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class PageController extends Controller
{
    public function landing()
    {
        if(Auth::check()) {
            return redirect('/home');
        }

        return view('welcome');
    }

    public function home()
    {
        return view('home');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function jooble()
    {
        return view('jooble');
    }

    public function rss()
    {
        return view('rss');
    }
}
