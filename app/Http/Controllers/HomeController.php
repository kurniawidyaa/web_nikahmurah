<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::guest() || Auth::user()->hasRole('user')) {
            return view('home', [
                'layanan' => Layanan::all(),
                'testimoni' => Testimoni::all(),
            ]);
        }
        if (Auth::user()->hasRole(['owner', 'admin'])) {
            return redirect()->route('dashboard');
        }
    }
}
