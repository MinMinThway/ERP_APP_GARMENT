<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts= Account::orderBy('id','desc')->get();
        return view('finance.staff.indexbanks',compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('finance.staff.addbanks');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'bankname'    => 'required|min:5',
            'accounttype' => 'required|min:3',
            'accountno'   => 'required|min:2',
            'balance'     => 'required|min:5'
        ]);

        $accounts = new Account;
        $accounts->bank       = $request->bankname;
        $accounts->type       = $request->accounttype;
        $accounts->acc_number = $request->accountno;
        $accounts->balance    = $request->balance;
        $accounts->save();

         return redirect()->route('account.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        return view('finance.staff.editbanks',compact('account'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $request->validate([
            'bankname'    => 'required|min:5',
            'accounttype' => 'required|min:3',
            'accountno'   => 'required|min:2',
            'balance'     => 'required|min:5' 
        ]);

        
        $account->bank       = $request->bankname;
        $account->type       = $request->accounttype;
        $account->acc_number = $request->accountno;
        $account->balance    = $request->balance;
        $account->save();
        
        return redirect()->route('account.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()->route('account.index');
    }

    public function newbudget(Request $request, Account $account)
    {
        
        $account = Account::orderBy('id','desc')->get();
        return view('finance.staff.addbudget',compact('account'));
    }

    public function account(Request $request, Account $account)
    {
        $data=Account::find($request->bank);

        echo json_encode($data);
    }

    public function amountadd(Request $request, Account $account)
    {
        $account= Account::find($request->id);
        $account->balance  =  $account->balance + $request->ammount;
        $account->save();
         return redirect()->route('account.index');
    }
        
}
