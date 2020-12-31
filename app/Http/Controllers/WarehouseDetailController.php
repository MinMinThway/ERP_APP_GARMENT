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
    public function get(Request $request)
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
}
