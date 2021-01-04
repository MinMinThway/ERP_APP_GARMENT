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
        return view('production.warehouse.home');
    }

    public function production_staff()
    {
        return view('production.staff.home');
    }

    public function production_admin()
    {
        return view('production.admin.home');
    }
     public function report()
    {
        return 'asdfjhsd';
    }

    public function procurement_staff()
    {
        return view('procurement.staff.home');
    }

    public function procurement_admin()
    {
        return view('procurement.admin.home');
    }

    public function finance_staff()
    {
        return view('finance.staff.home');
    }

    public function finance_admin()
    {
        return view('finance.admin.home');
    } 
}
