<?php

namespace App\Http\Controllers;

use App\Warehouse_detail;
use Illuminate\Http\Request;
use App\Warehouse;
use App\Order;
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
    $delivered_orders=Order::where('status_id','=','8')->orderBy('id','desc')->get(); // select finish order
    // dd($delivered_orders);
    $items=Warehouse::all();
    foreach ($items as $item) { // represent you items in warehouse
        foreach ($delivered_orders as $delivered_order) {   // represent delivered order            
            $break=false;
            foreach ($delivered_order->detail as $order_details) { // order in item                
                if ($item->id==$order_details->warehouse_id) {                    
                    $recieve=date('Y-m-d',strtotime($delivered_order->updated_at));
                    $lead_time=((abs(strtotime($delivered_order->date)-strtotime($recieve)))/(60*60*24));
                    $item->order_time_duration=$lead_time;
                    $item->save();
                    $break=true;
                    break;                    
                }
            }
            if ($break) {break;}
        }
    }
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function analysis()
    {
        //
        $warehouses=Warehouse::all();
        return view('production.staff.analysis',compact('warehouses'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report2() // production staff report
    {   
    // lead time
    $delivered_orders=Order::where('status_id','=','8')->orderBy('id','desc')->get(); // select finish order
    // dd($delivered_orders);
    $items=Warehouse::all();
    foreach ($items as $item) { // represent you items in warehouse
        foreach ($delivered_orders as $delivered_order) {   // represent delivered order            
            $break=false;
            foreach ($delivered_order->detail as $order_details) { // order in item                
                if ($item->id==$order_details->warehouse_id) {                    
                    $recieve=date('Y-m-d',strtotime($delivered_order->updated_at));
                    $lead_time=((abs(strtotime($delivered_order->date)-strtotime($recieve)))/(60*60*24));
                    $item->order_time_duration=$lead_time;
                    $item->save();
                    $break=true;
                    break;                    
                }
            }
            if ($break) {break;}
        }
    }
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
    return view('production.admin.report',compact('warehouses'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function analysis2()
    {
        //
        $warehouses=Warehouse::all();
        return view('production.admin.analysis',compact('warehouses'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function earning1()
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
        $day1_count=Warehouse_detail::where('date','=',$day1)->count();
        $day2_count=Warehouse_detail::where('date','=',$day2)->count();
        $day3_count=Warehouse_detail::where('date','=',$day3)->count();
        $day4_count=Warehouse_detail::where('date','=',$day4)->count();
        $day5_count=Warehouse_detail::where('date','=',$day5)->count();
        $day6_count=Warehouse_detail::where('date','=',$day6)->count();
        $day7_count=Warehouse_detail::where('date','=',$day7)->count();
    $total = array(
       $day1_count,$day2_count,$day3_count,$day4_count,
       $day5_count,$day6_count,$day7_count,$day1,$day2,
       $day3,$day4,$day5,$day6,$day7
    );
    echo json_encode($total);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function earning2()
    {
        // 1 jan
    date_default_timezone_set("Asia/Rangoon");
    $janStart = date('Y-m-d', strtotime('first day of january'));
    $janEnd = date('Y-m-d',strtotime('last day of january'));
    $janResult=Warehouse_detail::whereBetween('date', [$janStart, $janEnd])->count();
    // 2 february
    $febStart = date('Y-m-d', strtotime('first day of february'));
    $febEnd = date('Y-m-d',strtotime('last day of february'));
    $febResult=Warehouse_detail::whereBetween('date', [$febStart, $febEnd])->count();
    // 3 march
    $marchStart = date('Y-m-d', strtotime('first day of march'));
    $marchEnd = date('Y-m-d',strtotime('last day of march'));
    $marchResult=Warehouse_detail::whereBetween('date', [$marchStart, $marchEnd])->count();
    // 4 april
    $aprilStart = date('Y-m-d', strtotime('first day of april'));
    $aprilEnd = date('Y-m-d',strtotime('last day of april'));
    $aprilResult=Warehouse_detail::whereBetween('date', [$aprilStart, $aprilEnd])->count();
    // 5 may
    $mayStart = date('Y-m-d', strtotime('first day of may'));
    $mayEnd = date('Y-m-d',strtotime('last day of may'));
    $mayResult=Warehouse_detail::whereBetween('date', [$mayStart, $mayEnd])->count();
    // 6 june
    $junStart = date('Y-m-d', strtotime('first day of june'));
    $junEnd = date('Y-m-d',strtotime('last day of june'));
    $junResult=Warehouse_detail::whereBetween('date', [$junStart, $junEnd])->count();
    // 7 july
    $julStart = date('Y-m-d', strtotime('first day of july'));
    $julEnd = date('Y-m-d',strtotime('last day of july'));
    $julResult=Warehouse_detail::whereBetween('date', [$julStart, $julEnd])->count();
    // 8 august
    $augStart = date('Y-m-d', strtotime('first day of august'));
    $augEnd = date('Y-m-d',strtotime('last day of august'));
    $augResult=Warehouse_detail::whereBetween('date', [$augStart, $augEnd])->count();
    // 9 september
    $sepStart = date('Y-m-d', strtotime('first day of september'));
    $sepEnd = date('Y-m-d',strtotime('last day of september'));
    $sepResult=Warehouse_detail::whereBetween('date', [$sepStart, $sepEnd])->count();
    // 10 october
    $octStart = date('Y-m-d', strtotime('first day of october'));
    $octEnd = date('Y-m-d',strtotime('last day of october'));
    $octResult=Warehouse_detail::whereBetween('date', [$octStart, $octEnd])->count();
    // 11 november
    $novStart = date('Y-m-d', strtotime('first day of november'));
    $novEnd = date('Y-m-d',strtotime('last day of november'));
    $novResult=Warehouse_detail::whereBetween('date', [$octStart, $octEnd])->count();

    // 12 december
    $decStart = date('Y-m-d', strtotime('first day of december'));
    $decEnd = date('Y-m-d',strtotime('last day of december'));
    $decResult=Warehouse_detail::whereBetween('date', [$decStart, $decEnd])->count();

    $total = array(
        $janResult,$febResult,$marchResult,$aprilResult,
        $mayResult,$junResult,$julResult,$augResult,
        $sepResult,$octResult,$novResult,$decResult,
    );
    echo json_encode($total);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function earning3()
    {
        // 1 jan
    date_default_timezone_set("Asia/Rangoon");
    $janStart = date('Y-m-d', strtotime('first day of january'));
    $janEnd = date('Y-m-d',strtotime('last day of january'));
    $janResult=Warehouse_detail::whereBetween('date', [$janStart, $janEnd])->count();
    // 2 february
    $febStart = date('Y-m-d', strtotime('first day of february'));
    $febEnd = date('Y-m-d',strtotime('last day of february'));
    $febResult=Warehouse_detail::whereBetween('date', [$febStart, $febEnd])->count();
    // 3 march
    $marchStart = date('Y-m-d', strtotime('first day of march'));
    $marchEnd = date('Y-m-d',strtotime('last day of march'));
    $marchResult=Warehouse_detail::whereBetween('date', [$marchStart, $marchEnd])->count();
    // 4 april
    $aprilStart = date('Y-m-d', strtotime('first day of april'));
    $aprilEnd = date('Y-m-d',strtotime('last day of april'));
    $aprilResult=Warehouse_detail::whereBetween('date', [$aprilStart, $aprilEnd])->count();
    // 5 may
    $mayStart = date('Y-m-d', strtotime('first day of may'));
    $mayEnd = date('Y-m-d',strtotime('last day of may'));
    $mayResult=Warehouse_detail::whereBetween('date', [$mayStart, $mayEnd])->count();
    // 6 june
    $junStart = date('Y-m-d', strtotime('first day of june'));
    $junEnd = date('Y-m-d',strtotime('last day of june'));
    $junResult=Warehouse_detail::whereBetween('date', [$junStart, $junEnd])->count();
    // 7 july
    $julStart = date('Y-m-d', strtotime('first day of july'));
    $julEnd = date('Y-m-d',strtotime('last day of july'));
    $julResult=Warehouse_detail::whereBetween('date', [$julStart, $julEnd])->count();
    // 8 august
    $augStart = date('Y-m-d', strtotime('first day of august'));
    $augEnd = date('Y-m-d',strtotime('last day of august'));
    $augResult=Warehouse_detail::whereBetween('date', [$augStart, $augEnd])->count();
    // 9 september
    $sepStart = date('Y-m-d', strtotime('first day of september'));
    $sepEnd = date('Y-m-d',strtotime('last day of september'));
    $sepResult=Warehouse_detail::whereBetween('date', [$sepStart, $sepEnd])->count();
    // 10 october
    $octStart = date('Y-m-d', strtotime('first day of october'));
    $octEnd = date('Y-m-d',strtotime('last day of october'));
    $octResult=Warehouse_detail::whereBetween('date', [$octStart, $octEnd])->count();
    // 11 november
    $novStart = date('Y-m-d', strtotime('first day of november'));
    $novEnd = date('Y-m-d',strtotime('last day of november'));
    $novResult=Warehouse_detail::whereBetween('date', [$octStart, $octEnd])->count();

    // 12 december
    $decStart = date('Y-m-d', strtotime('first day of december'));
    $decEnd = date('Y-m-d',strtotime('last day of december'));
    $decResult=Warehouse_detail::whereBetween('date', [$decStart, $decEnd])->count();

    $total = array(
        $janResult,$febResult,$marchResult,$aprilResult,
        $mayResult,$junResult,$julResult,$augResult,
        $sepResult,$octResult,$novResult,$decResult,
    );
    echo json_encode($total);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function earning4()
    {
        // 1 jan
    date_default_timezone_set("Asia/Rangoon");
    $janStart = date('Y-m-d', strtotime('first day of january'));
    $janEnd = date('Y-m-d',strtotime('last day of january'));
    $janResult=Warehouse_detail::whereBetween('date', [$janStart, $janEnd])->count();
    // 2 february
    $febStart = date('Y-m-d', strtotime('first day of february'));
    $febEnd = date('Y-m-d',strtotime('last day of february'));
    $febResult=Warehouse_detail::whereBetween('date', [$febStart, $febEnd])->count();
    // 3 march
    $marchStart = date('Y-m-d', strtotime('first day of march'));
    $marchEnd = date('Y-m-d',strtotime('last day of march'));
    $marchResult=Warehouse_detail::whereBetween('date', [$marchStart, $marchEnd])->count();
    // 4 april
    $aprilStart = date('Y-m-d', strtotime('first day of april'));
    $aprilEnd = date('Y-m-d',strtotime('last day of april'));
    $aprilResult=Warehouse_detail::whereBetween('date', [$aprilStart, $aprilEnd])->count();
    // 5 may
    $mayStart = date('Y-m-d', strtotime('first day of may'));
    $mayEnd = date('Y-m-d',strtotime('last day of may'));
    $mayResult=Warehouse_detail::whereBetween('date', [$mayStart, $mayEnd])->count();
    // 6 june
    $junStart = date('Y-m-d', strtotime('first day of june'));
    $junEnd = date('Y-m-d',strtotime('last day of june'));
    $junResult=Warehouse_detail::whereBetween('date', [$junStart, $junEnd])->count();
    // 7 july
    $julStart = date('Y-m-d', strtotime('first day of july'));
    $julEnd = date('Y-m-d',strtotime('last day of july'));
    $julResult=Warehouse_detail::whereBetween('date', [$julStart, $julEnd])->count();
    // 8 august
    $augStart = date('Y-m-d', strtotime('first day of august'));
    $augEnd = date('Y-m-d',strtotime('last day of august'));
    $augResult=Warehouse_detail::whereBetween('date', [$augStart, $augEnd])->count();
    // 9 september
    $sepStart = date('Y-m-d', strtotime('first day of september'));
    $sepEnd = date('Y-m-d',strtotime('last day of september'));
    $sepResult=Warehouse_detail::whereBetween('date', [$sepStart, $sepEnd])->count();
    // 10 october
    $octStart = date('Y-m-d', strtotime('first day of october'));
    $octEnd = date('Y-m-d',strtotime('last day of october'));
    $octResult=Warehouse_detail::whereBetween('date', [$octStart, $octEnd])->count();
    // 11 november
    $novStart = date('Y-m-d', strtotime('first day of november'));
    $novEnd = date('Y-m-d',strtotime('last day of november'));
    $novResult=Warehouse_detail::whereBetween('date', [$octStart, $octEnd])->count();

    // 12 december
    $decStart = date('Y-m-d', strtotime('first day of december'));
    $decEnd = date('Y-m-d',strtotime('last day of december'));
    $decResult=Warehouse_detail::whereBetween('date', [$decStart, $decEnd])->count();

    $total = array(
        $janResult,$febResult,$marchResult,$aprilResult,
        $mayResult,$junResult,$julResult,$augResult,
        $sepResult,$octResult,$novResult,$decResult,
    );
    echo json_encode($total);
    }
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function earning5()
    {
        // 1 jan
    date_default_timezone_set("Asia/Rangoon");
    $janStart = date('Y-m-d', strtotime('first day of january'));
    $janEnd = date('Y-m-d',strtotime('last day of january'));
    $janResult=Warehouse_detail::whereBetween('date', [$janStart, $janEnd])->count();
    // 2 february
    $febStart = date('Y-m-d', strtotime('first day of february'));
    $febEnd = date('Y-m-d',strtotime('last day of february'));
    $febResult=Warehouse_detail::whereBetween('date', [$febStart, $febEnd])->count();
    // 3 march
    $marchStart = date('Y-m-d', strtotime('first day of march'));
    $marchEnd = date('Y-m-d',strtotime('last day of march'));
    $marchResult=Warehouse_detail::whereBetween('date', [$marchStart, $marchEnd])->count();
    // 4 april
    $aprilStart = date('Y-m-d', strtotime('first day of april'));
    $aprilEnd = date('Y-m-d',strtotime('last day of april'));
    $aprilResult=Warehouse_detail::whereBetween('date', [$aprilStart, $aprilEnd])->count();
    // 5 may
    $mayStart = date('Y-m-d', strtotime('first day of may'));
    $mayEnd = date('Y-m-d',strtotime('last day of may'));
    $mayResult=Warehouse_detail::whereBetween('date', [$mayStart, $mayEnd])->count();
    // 6 june
    $junStart = date('Y-m-d', strtotime('first day of june'));
    $junEnd = date('Y-m-d',strtotime('last day of june'));
    $junResult=Warehouse_detail::whereBetween('date', [$junStart, $junEnd])->count();
    // 7 july
    $julStart = date('Y-m-d', strtotime('first day of july'));
    $julEnd = date('Y-m-d',strtotime('last day of july'));
    $julResult=Warehouse_detail::whereBetween('date', [$julStart, $julEnd])->count();
    // 8 august
    $augStart = date('Y-m-d', strtotime('first day of august'));
    $augEnd = date('Y-m-d',strtotime('last day of august'));
    $augResult=Warehouse_detail::whereBetween('date', [$augStart, $augEnd])->count();
    // 9 september
    $sepStart = date('Y-m-d', strtotime('first day of september'));
    $sepEnd = date('Y-m-d',strtotime('last day of september'));
    $sepResult=Warehouse_detail::whereBetween('date', [$sepStart, $sepEnd])->count();
    // 10 october
    $octStart = date('Y-m-d', strtotime('first day of october'));
    $octEnd = date('Y-m-d',strtotime('last day of october'));
    $octResult=Warehouse_detail::whereBetween('date', [$octStart, $octEnd])->count();
    // 11 november
    $novStart = date('Y-m-d', strtotime('first day of november'));
    $novEnd = date('Y-m-d',strtotime('last day of november'));
    $novResult=Warehouse_detail::whereBetween('date', [$octStart, $octEnd])->count();

    // 12 december
    $decStart = date('Y-m-d', strtotime('first day of december'));
    $decEnd = date('Y-m-d',strtotime('last day of december'));
    $decResult=Warehouse_detail::whereBetween('date', [$decStart, $decEnd])->count();

    $total = array(
        $janResult,$febResult,$marchResult,$aprilResult,
        $mayResult,$junResult,$julResult,$augResult,
        $sepResult,$octResult,$novResult,$decResult,
    );
    echo json_encode($total);
    }
}
