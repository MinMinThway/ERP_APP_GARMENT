<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;

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
        $account = Account::all();
        return view('finance.staff.home',compact('account'));
    }

    public function finance_admin()
    {   
        $account = Account::all();
        return view('finance.admin.home',compact('account'));
    }
}
