<?php

namespace App\Http\Controllers;

use App\Order;
use App\Order_detail;
use Illuminate\Http\Request;
use App\Warehouse_detail;
use App\Warehouse;
use App\Account;
use App\Account_detail;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
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
    public function create(Request $request)
    {
    DB::transaction(function() use ($request){
        $data=$_GET['data'];
        $arrays=json_decode($data);
        date_default_timezone_set("Asia/Rangoon");        
        $today=date('Y-m-d',strtotime('today'));

        $order=new Order;
        $order->date=$today;
        $order->status_id=1;
        $order->save();

        $data=$_GET['data'];
        $arrays=json_decode($data);
        foreach ($arrays as $array) {
            $order_detail=new Order_detail;
            $order_detail->qty=$array->qty;
            $order_detail->UOM=$array->UOM;
            $order_detail->warehouse_id=$array->warehouse_id;
            $order_detail->order_id=$order->id;
            $order_detail->save();
        }
        echo 'done';
    });
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
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delivery()
    {
        //
        $orders=Order::where('status_id','=',7)->get();
        // dd($orders[0]->supplier->company_name);
        return view('production.warehouse.delivery',compact('orders'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        //
        $orders=Order::where('status_id','=',8)->get();
        return view('production.warehouse.history',compact('orders'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function deliveryInfo(Request $request)
    {
        //
        $id = $request->id;
        $order=Order::find($id);
        return view('production.warehouse.deliveryInfo',compact('order'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function deliveredInfo(Request $request)
    {
        //
        $id = $request->id;
        $order=Order::find($id);
        return view('production.warehouse.deliveredInfo',compact('order'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function staff_0_history()
    {
        //
        $orders=Order::where('status_id','>=',1)->get();
        return view('production.staff.history',compact('orders'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function order_0_info(Request $request)
    {
        //
        $id = $request->id;
        $order=Order::find($id);
        return view('production.staff.info',compact('order'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_1_history()
    {
        //
        $orders=Order::where('status_id','>=',2)->get();
        return view('production.admin.history',compact('orders'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function order_1_info(Request $request)
    {
        //
        $id = $request->id;
        $order=Order::find($id);
        return view('production.admin.info',compact('order'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function staff_2_history()
    {
        //
        $orders=Order::where('status_id','>=',3)->get();
        return view('procurement.staff.history',compact('orders'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function order_2_info(Request $request)
    {
        //
        $id = $request->id;
        $order=Order::find($id);
        return view('procurement.staff.info',compact('order'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_3_history()
    {
        //
        $orders=Order::where('status_id','>=',4)->get();
        return view('procurement.admin.history',compact('orders'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function order_3_info(Request $request)
    {
        //
        $id = $request->id;
        $order=Order::find($id);
        return view('procurement.admin.info',compact('order'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function staff_4_history()
    {
        //
        $orders=Order::where('status_id','>=',5)->get();
        return view('finance.staff.history',compact('orders'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function order_4_info(Request $request)
    {
        //
        $id = $request->id;
        $order=Order::find($id);
        return view('finance.staff.info',compact('order'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_5_history()
    {
        //
        $orders=Order::where('status_id','>=',6)->get();
        return view('finance.admin.history',compact('orders'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function order_5_info(Request $request)
    {
        //
        $id = $request->id;
        $order=Order::find($id);
        return view('finance.admin.info',compact('order'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function delivered(Request $request)  // transection create
    {
        //
    DB::transaction(function() use ($request){
        $id = $request->id;
        $order=Order::find($id);

        foreach ($order->detail as $details) {    

            date_default_timezone_set("Asia/Rangoon");
            $todayDate = date('Y-m-d',strtotime('today'));

            $input=$details->qty;
            
            $warehouse=Warehouse::find($details->warehouse_id);
            $old_qty=$warehouse->stock_qty;


            $order_detail=new Warehouse_detail;
            $order_detail->date=$todayDate;
            $order_detail->input_qty=$input;
            $order_detail->stock=$old_qty+$input;
            $order_detail->warehouse_id=$details->warehouse_id;
            $order_detail->save();
            

            $warehouse->stock_qty=$old_qty+$input;
            $warehouse->save();
        }
        $order->status_id=8;
        $order->save();
    });
    return redirect()->route('delivery');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order_create() // production/staff/order create
    {
        //
        $warehouses = Warehouse::all();
        return view('production.staff.order',compact('warehouses'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order_2_index() // procurement/staff/order edit/update
    {
        //
        $orders = Order::where('status_id','=',2)->get();
        return view('procurement.staff.order',compact('orders'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function set_supplier() // procurement/staff/set supplier
    {
        //
        $order_id=$_GET['oid'];
        $supplier_id=$_GET['sid'];
        $order=Order::find($order_id);
        $order->supplier_id=$supplier_id;
        $order->save();
        echo 'done';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function set_price() // procurement/staff/set price
    {
        //
        $id=$_GET['id'];
        $price=$_GET['price'];

        $detail=Order_detail::find($id);
        $detail->price=$price;
        $detail->save();
        echo number_format($price,2);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function order_edit(Request $request, Order $order)  // procurement/staff/ order edit page
    {
        //
        $id=$request->id;
        $order=Order::find($id);
        return view('procurement.staff.order_edit',compact('order'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function status_2_change(Request $request, Order $order) // procurement/staff/ status chage
    {
        //
        session_start();
        $id=$request->id;

        $order=Order::find($id);
        if ($order->supplier_id<2) {
            $_SESSION['errortype']='Supplier Requirement Fail !';
            $_SESSION['error']='sorry we cant change status your order "ERP#'.$order->id.'" is does not have supplier please check again!';
            return redirect()->route('status_2_change_error');
            exit();
        }
        foreach ($order->detail as $item) {
            if ($item->price>0) {
                var_dump($item->price);
            }else{
                $_SESSION['errortype']='Price does not match!';
                $warehouse=Warehouse::find($item->warehouse_id);
                $_SESSION['error']='your selected product "'.$warehouse->name.'", price ="'.$item->price.'" is cannot be set. Please check again!';
                return redirect()->route('status_2_change_error');
                exit();
            }
        }
        $order->status_id=3;
        $order->denile_note=null;
        $order->save();
        $_SESSION['successtitle']='Congratulations! you have successfully.';
        $_SESSION['success']='Your admin is approve after checking process.';
        return redirect()->route('status_2_change_success');   

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function status_2_change_error(Request $request, Order $order) // procurement/staff/ status chage error
    {
        return view('procurement.staff.error');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function status_2_change_success(Request $request, Order $order) // procurement/staff/ status chage error
    {
        return view('procurement.staff.success');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function note_2_get() // get/reject/note
    {
        //
        $id=$_GET['id'];
        $order=Order::find($id);
        echo $order->denile_note;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order_3_index() // procurement/admin/order list
    {
        //
        $orders = Order::where('status_id','=',3)->get();
        return view('procurement.admin.order',compact('orders'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function order_3_detail(Request $request, Order $order)  // procurement/admin/ check order detail
    {
        //
        $id=$request->id;
        $order=Order::find($id);
        return view('procurement.admin.detail',compact('order'));
   
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function order_3_reject(Request $request, Order $order)  // procurement/admin/ check order detail
    {
        //
        $id=$request->id;
        $note=$request->note;
        $order=Order::find($id);
        $order->denile_note=$note;
        $order->status_id=$order->status_id-1;
        $order->save();

        $orders = Order::where('status_id','=',3)->get();
        return view('procurement.admin.order',compact('orders'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function status_3_change(Request $request, Order $order) // procurement/staff/ status chage
    {
        //
        $id=$request->id;
        $order=Order::find($id);
        $order->status_id=4;
        $order->save();
        return redirect()->route('procurement.admin.order');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order_4_index()
    {
        //
        $orders=Order::where('status_id','=',4)->get();
        return view('finance.staff.orders',compact('orders'));
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function order_4_edit(Request $request, Order $order)
    {
        $id=$request->id;
        $order=Order::find($id);
        $account=Account::all();
        return view('finance.staff.detailorder',compact('order','account'));

        // $order_id=$request->orderid;
        // $detail=Order_detail::all();
        // $order = Order::find($order_id);
        // return view('finance.staff.detailorder',compact('order',));
    }

    public function order_4_update(Request $request, Order $order)
    {   

        
        $id = $request->id;
        $accountid=$request->account;
        $oldtotal=$request->balance;

        //dd($request->cheque);
        // $cheque=$request->cheque;
        DB::transaction(function() use ($request){
            date_default_timezone_set("Asia/Rangoon");
            $today = date('Y-m-d',strtotime('today'));

            $order=Order::find($request->id);
            $order->cheque_no=$request->cheque;
            $order->status_id=5;
            $order->save();

            $account= Account::find($request->account);
            $oldbalance = $account->balance;
            $newbalance = $request->balance;
            $tranbalance = $oldbalance - $newbalance;
            

            $accountdetail=new Account_detail;
            $accountdetail->date=$today;
            $accountdetail->outcome=$request->balance;
            $accountdetail->tranbalance= $tranbalance;
            $accountdetail->account_id= $request->account;
            $accountdetail->save();

            $account->balance  =   $tranbalance;
            $account->save();
        });

        return redirect()->route('finance.staff.balancesheet');
    }

    public function order_4_reject(Request $request, Order $order)
    {
        dd($request);
        DB::transaction(function() use ($request){
            $order=Order::find($request->id);
            $order->denile_note=$request->denile;
            $order->status_id=3;
            $order->save();
        });
    }

    
}