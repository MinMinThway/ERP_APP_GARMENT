<?php

namespace App\Http\Controllers;

use App\Order;
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

}
