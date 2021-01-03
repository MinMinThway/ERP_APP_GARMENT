<?php

namespace App\Http\Controllers;

use App\Account_detail;
use Illuminate\Http\Request;
use App\Account;
use Illuminate\Support\Facades\DB;

class AccountDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account_detail  $account_detail
     * @return \Illuminate\Http\Response
     */
    public function show(Account_detail $account_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account_detail  $account_detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Account_detail $account_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account_detail  $account_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account_detail $account_detail)
    {
        //  DB::transaction(function() use ($request){
        //     date_default_timezone_set("Asia/Rangoon");
        //     $today = date('Y-m-d',strtotime('today'));

        // $input=$request->input;

        // $account= Account::find($request->id);
         
        //  $accountdetail=new Account_detail;
        //  $accountdetail->date=$today;
        //  $accountdetail->income=$request->ammount;
        //  $accountdetail->tranbalance= $account->balance + $request->ammount;
        //  $accountdetail->account_id= $request->id;

        // $accountdetail->save();

        // $account->balance  =  $account->balance + $request->ammount;
        // $account->save();
        //  return redirect()->route('account.index');

        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account_detail  $account_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account_detail $account_detail)
    {
        //
    }


    public function account(Request $request, Account_detail $account_detail)
    {
        $data=Account::find($request->bank);

        echo json_encode($data);
    }

    public function amountadd(Request $request, Account_detail $account_detail)
    {
         DB::transaction(function() use ($request){
            date_default_timezone_set("Asia/Rangoon");
            $today = date('Y-m-d',strtotime('today'));

        $input=$request->input;

        $account= Account::find($request->id);
        $oldbalance = $account->balance;
        $newbalance = $request->ammount;
        $tranbalance = $oldbalance + $newbalance;
         //dd($tranbalance);
        
         $accountdetail=new Account_detail;

         $accountdetail->date=$today;
         $accountdetail->income=$request->ammount;
         $accountdetail->tranbalance= $tranbalance;
         $accountdetail->account_id= $request->id;

        $accountdetail->save();

        $account->balance  =   $tranbalance;
        $account->save();
         
        });
         return view('finance.staff.home');

    }
}
