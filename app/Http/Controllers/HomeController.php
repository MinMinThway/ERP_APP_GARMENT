<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function warehouse()
    {

    }

    public function production_staff()
    {
        
    }

    public function production_admin()
    {
        
    }

    public function procuremnt_staff()
    {
        
    }

    public function procuremnt_admin()
    {
        
    }

    public function finance_staff()
    {
        
    }

    public function finance_admin()
    {
        
    } 
}
