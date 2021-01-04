<?php

namespace App\Http\Controllers;

use App\Order;
use App\Order_detail;
use Illuminate\Http\Request;
use App\Warehouse_detail;
use App\Warehouse;
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
        $detail->price=number_format($price,2);
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
}
