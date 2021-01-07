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


    //  public function checkaccount(Request $request, Account_detail $account_detail)
    // {
    //     $data=Account::find($request->bank);
    //     echo json_encode($data);
    // }

    public function account(Request $request, Account_detail $account_detail)
    {
        $data=Account::find($request->bank);
        echo json_encode($data);
    }

    public function amountadd(Request $request, Account_detail $account_detail)
    {

        $input=$request->input;
         DB::transaction(function() use ($request){
            date_default_timezone_set("Asia/Rangoon");
            $today = date('Y-m-d',strtotime('today'));

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
         
         return redirect()->route('account.index');
    }


public function acearning()
    {
        //
        date_default_timezone_set("Asia/Rangoon");
        $d1=strtotime('-3day today');
        $d2=strtotime('-2day today');
        $d3=strtotime('-1day today');
        $d4=strtotime('today');
        $d5=strtotime('+1day today');
        $d6=strtotime('+2day today');
        $d7=strtotime('+3day today');
        $day1=date('Y-m-d',$d1);
        $day2=date('Y-m-d',$d2);
        $day3=date('Y-m-d',$d3);
        $day4=date('Y-m-d',$d4);
        $day5=date('Y-m-d',$d5);
        $day6=date('Y-m-d',$d6);
        $day7=date('Y-m-d',$d7);
        $day1_count=Account_detail::select('outcome')->where('date','=',$day1)->sum('outcome');
        $day2_count=Account_detail::select('outcome')->where('date','=',$day2)->sum('outcome');
        $day3_count=Account_detail::select('outcome')->where('date','=',$day3)->sum('outcome');
        $day4_count=Account_detail::select('outcome')->where('date','=',$day4)->sum('outcome');
        $day5_count=Account_detail::select('outcome')->where('date','=',$day5)->sum('outcome');
        $day6_count=Account_detail::select('outcome')->where('date','=',$day6)->sum('outcome');
        $day7_count=Account_detail::select('outcome')->where('date','=',$day7)->sum('outcome');
    $total = array(
       $day1_count,$day2_count,$day3_count,$day4_count,
       $day5_count,$day6_count,$day7_count,$day1,$day2,
       $day3,$day4,$day5,$day6,$day7
    );
    echo json_encode($total);
    }  



    public function acearning2()
    {
        //
        date_default_timezone_set("Asia/Rangoon");
        $d1=strtotime('-3day today');
        $d2=strtotime('-2day today');
        $d3=strtotime('-1day today');
        $d4=strtotime('today');
        $d5=strtotime('+1day today');
        $d6=strtotime('+2day today');
        $d7=strtotime('+3day today');
        $day1=date('Y-m-d',$d1);
        $day2=date('Y-m-d',$d2);
        $day3=date('Y-m-d',$d3);
        $day4=date('Y-m-d',$d4);
        $day5=date('Y-m-d',$d5);
        $day6=date('Y-m-d',$d6);
        $day7=date('Y-m-d',$d7);
        $day1_count=Account_detail::select('outcome')->where('date','=',$day1)->sum('outcome');
        $day2_count=Account_detail::select('outcome')->where('date','=',$day2)->sum('outcome');
        $day3_count=Account_detail::select('outcome')->where('date','=',$day3)->sum('outcome');
        $day4_count=Account_detail::select('outcome')->where('date','=',$day4)->sum('outcome');
        $day5_count=Account_detail::select('outcome')->where('date','=',$day5)->sum('outcome');
        $day6_count=Account_detail::select('outcome')->where('date','=',$day6)->sum('outcome');
        $day7_count=Account_detail::select('outcome')->where('date','=',$day7)->sum('outcome');
    $total = array(
       $day1_count,$day2_count,$day3_count,$day4_count,
       $day5_count,$day6_count,$day7_count,$day1,$day2,
       $day3,$day4,$day5,$day6,$day7
    );
    echo json_encode($total);
    }  
}

