<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kades;
use App\LoginVote;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kades = Kades::get();
        return view('home', compact('kades'));
    }
}
