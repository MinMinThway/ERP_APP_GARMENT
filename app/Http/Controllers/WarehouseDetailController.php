<?php

namespace App\Http\Controllers;

use App\Warehouse_detail;
use Illuminate\Http\Request;
use App\Warehouse;
use Illuminate\Support\Facades\DB;
class WarehouseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $details=Warehouse_detail::OrderBy('id','desc')->get();
        return view('production.warehouse.inventory',compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $warehouses = Warehouse::all();
        return view('production.warehouse.inventory_create',compact('warehouses'));
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
     * @param  \App\Warehouse_detail  $warehouse_detail
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse_detail $warehouse_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Warehouse_detail  $warehouse_detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse_detail $warehouse_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Warehouse_detail  $warehouse_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse_detail $warehouse_detail)
    {
        //
    DB::transaction(function() use ($request){
        date_default_timezone_set("Asia/Rangoon");
        $todayDate = date('Y-m-d',strtotime('today'));

        // var_dump($todayDate).die();
        $id=$request->id;
        $input=$request->input;
        $output=$request->output;
        
        if ($input>0 && $output>0) {
            echo 'error1';
            exit();
        }
        if (($input=='' && $output=='')||($input=='0' && $output=='0')) {
            echo 'error2';
            exit();
        }

        $warehouse=Warehouse::find($id);
        $old_qty=$warehouse->stock_qty;
        if ($old_qty>=$output) {
            $detail=new Warehouse_detail;
            $detail->date=$todayDate;
            $detail->input_qty=$input;
            $detail->output_qty=$output;
            $detail->warehouse_id=$id;
            if ($input>0 && ($output=='' || $output=='0')) {
                    $detail->stock=$old_qty+$input;
            }else{
                if ($output>0 && ($input=='' || $input=='0')) {
                    $detail->stock=$old_qty-$output;
                }    
            }
            $detail->save();

            $warehouse=Warehouse::find($id);
            $old_qty=$warehouse->stock_qty;
            if ($input>0 && ($output=='' || $output=='0')) {
                    $warehouse->stock_qty=$old_qty+$input;
            }else{
                if ($output>0 && ($input=='' || $input=='0')) {
                    $warehouse->stock_qty=$old_qty-$output;
                }    
            }
            $warehouse->save();
            echo $warehouse->stock_qty;
        } else {
            echo 'error3';
            exit();
        }
    });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Warehouse_detail  $warehouse_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse_detail $warehouse_detail)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Warehouse_detail  $warehouse_detail
     * @return \Illuminate\Http\Response
     */
    public function get1(Request $request)  // From warehouse user
    {
        //
        $detail=Warehouse::find($request->id);
        echo json_encode($detail);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Warehouse_detail  $warehouse_detail
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)  // From production staff user
    {
        //
        $detail=Warehouse::find($request->id);
        echo json_encode($detail);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report() // production staff report
    {   
        // lead time

        // lead time 
        // calculation reorder date
        $warehouse_details = Warehouse_detail::select(DB::raw('sum(output_qty) as total_output'),
            DB::raw('count(DISTINCT date) as total_day'),'warehouse_id')
                    ->groupBy('warehouse_id')
                    ->get();
        foreach ($warehouse_details as $value) {
            $avg_out_day=$value->total_output/$value->total_day; // avg consume
            $stock=Warehouse::find($value->warehouse_id);
            if ($avg_out_day>0) {   // check have transection items
                $day_left=number_format($stock->stock_qty/$avg_out_day,0)-($stock->order_time_duration*$stock->stock_safety_factor); // day left for orders
                // if ($day_left>0) {
                    $d=strtotime('+'.$day_left.' day');
                    $reorder_date=date('Y-m-d',strtotime('today',$d));
                    $stock->reorder_date=$reorder_date;
                    $stock->save();
                // }
             }           
        }
        // calculation reorder date
        $warehouses=Warehouse::orderBy('reorder_date')
            ->where('reorder_date','!=',null)
            ->get();
        return view('production.staff.report',compact('warehouses'));
    }
}
