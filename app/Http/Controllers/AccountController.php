<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;
use App\Order;
use App\Account_detail;

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
            'bankname'    => 'required|min:3',
            'accounttype' => 'required|min:3',
            'accountno'   => 'required|min:2',
            'balance'     => 'required|min:3'
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
        
        $account = Account::all();
        return view('finance.staff.addbudget',compact('account'));
    }

    // public function balancesheet(){
    // $orders=Order::where('status_id','=',2)->get();
    // $account_details=Account_detail::orderBy('id','desc')->get();
    // return view('finance.staff.balancesheet',compact('orders','account_details'));
    // }


    // public function balancesheet(){
    // $orders=Order::where('status_id','=',2)->get();
    // $account_details=Account_detail::orderBy('id','desc')->get();
    // return view('finance.staff.balancesheet',compact('orders','account_details'));
    // }



    // public function newbudget(Request $request, Account $account)
    // {
        
    //     $account = Account::orderBy('id','desc')->get();
    //     return view('finance.staff.addbudget',compact('account'));
    // }

    // public function account(Request $request, Account $account)
    // {
    //     $data=Account::find($request->bank);

    //     echo json_encode($data);
    // }

    // public function amountadd(Request $request, Account $account)
    // {
    //     $account= Account::find($request->id);
    //     $account->balance  =  $account->balance + $request->ammount;
    //     $account->save();
    //      return redirect()->route('account.index');
    // }

        public function balancesheetsearch()
        {
            $account = Account::all();
            return view('finance.staff.balancesheetbybank',compact('account'));
        }

        public function balancesheet(Request $request){ 
             //dd($request->bankname);

            // dd($id);
            $orders=Order::where('status_id','=',5)->get();
            $accounts=Account::where('bank','=',$request->bankname)->get();
            $account_details=Account_detail::where('account_id','=',$request->bankname)->get();
            return view('finance.staff.balancesheet',compact('orders','account_details','accounts'));
        }


        //  public function dailylyreport(Request $request){      
        //     $date=date('d-m-Y',strtotime($request->date));
        //     if ($request->date) {
        //         $orders = Order::where('date','=',$request->date)->get();
        //         $sum = Order::where('date','=',$request->date)->sum('total');
        //     }
        //     return view('finance.staff.dailyreport',compact('orders','sum','date'));

        // }


        public function searchreport()
        {
            return view('finance.staff.reportsearch');
        }

        public function monthlysearchreport()
        {
            return view('finance.staff.monthlyreportsearch');
        }

         public function yearlysearchreport()
        {
            return view('finance.staff.yearlyreportsearch');
        }


        public function dailylyreport(Request $request){      
            $date=date('d-m-Y',strtotime($request->date));
            if ($request->date) {
                $orders = Order::where('date','=',$request->date)->get();
                $sum = Order::where('date','=',$request->date)->sum('total');
            }
            return view('finance.staff.dailyreport',compact('orders','sum','date'));

        }
        
        public function monthlyreport(Request $request){

             
            
            $month=date('Y-m',strtotime($request->month));

            //dd($month);
            if ($month) {

                $orders = Order::where('date','like', '%' . $month . '%')->get();


                $sum = Order::where('date','like', '%' . $month . '%')->sum('total');


            }
            //dd($month);
           // dd($orders);
            return view('finance.staff.monthlyreport',compact('orders','sum','month'));
        }

        public function yearlyreport(Request $request){
            
            $year=$request->year;

            if ($request->year) {
                $orders = Order::where('date','like', '%' . $year . '%')->get();
                $sum = Order::where('date','like', '%' . $year . '%')->sum('total');
            }
            return view('finance.staff.yearlyreport',compact('orders','sum','year'));
        }

    // public function account(Request $request, Account_detail $account_detail)
    // {
    //     $datas=Account::find($request->bank);

    //     echo json_encode($datas);
    // }

}
