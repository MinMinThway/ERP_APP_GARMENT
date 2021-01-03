@extends('production.warehouse.master')
@php
use App\Warehouse;
use App\Warehouse_detail;
  // Total Material
  $count_items=Warehouse::all()->count();
  
  // Today Transection

   // $tests=Warehouse_detail::whereBetween('date',['2020-12-20','2020-12-26'])->get();
   // $i=1;
   // foreach ($tests as $test) {
   //   $test->date='2020-12-27';
   //   $test->save();
   // }
   // var_dump($tests).die();
  // date_default_timezone_set("Asia/Rangoon");
  $todayDate = date('Y-m-d',strtotime('today'));
  $yesterday = date('Y-m-d',strtotime('Yesterday'));
  $today_transection=Warehouse_detail::where('date','=',$todayDate)->count();
  $yesterday_transection=Warehouse_detail::where('date','=',$yesterday)->count();
  $df_ct_ps_up=0;
  $df_ct_ps_down=0;
  $d_zero_div=false;
  if ($today_transection>$yesterday_transection) {
    // trend
    $df_ct_day=$today_transection-$yesterday_transection;
    if ($yesterday_transection<1) {
      $d_zero_div=true;
    } else {
    $df_ct_ps_up=number_format((($df_ct_day*100)/$yesterday_transection),0);
    }
  }else{
    if ($yesterday_transection<1) {
      $d_zero_div=true;
    } else {
    $df_ct_day=$yesterday_transection-$today_transection;
    $df_ct_ps_down=number_format(($df_ct_day*100)/$yesterday_transection,0);
    }
  }

  // Today Transection
  
  // week Transection
  // This Week
  $d = strtotime("today");
  $start_week = strtotime("last sunday midnight",$d);
  $end_week = strtotime("next saturday",$d);
  $start = date("Y-m-d",$start_week); 
  $end = date("Y-m-d",$end_week);

  // Past Week
  $dp = strtotime("-1 week -1 day");
  $start_weekp = strtotime("last sunday midnight",$dp);
  $end_weekp = strtotime("next saturday",$dp);
  $startp = date("Y-m-d",$start_weekp); 
  $endp = date("Y-m-d",$end_weekp);

  $this_week=Warehouse_detail::whereBetween('date', [$start, $end])->count();
  $past_week=Warehouse_detail::whereBetween('date', [$startp, $endp])->count();
  $df_ct_wk_up=0;
  $df_ct_wk_down=0;
  $w_zero_div=false;
  if ($this_week>$past_week) {
    // trend
    $df_ct_week=$this_week-$past_week;
    if ($past_week<1) {
      $w_zero_div=true;
    } else {
    $df_ct_wk_up=number_format((($df_ct_week*100)/$past_week),0);
    }
  }else{
    if ($past_week<1) {
      $w_zero_div=true;
    } else {
    $df_ct_week=$past_week-$this_week;
    $df_ct_wk_down=number_format((($df_ct_week*100)/$past_week),0);
    }
  }

  // week Transection

  //Months Transection
$start_this_month=date('Y-m-d',strtotime('first day of this Month'));
$end_this_month=date('Y-m-d',strtotime('last day of this Month'));

$start_past_month=date('Y-m-d',strtotime('first day of this Month',strtotime("-1 month")));
$end_past_month=date('Y-m-d',strtotime('last day of this Month',strtotime("-1 month")));

$this_month=Warehouse_detail::whereBetween('date', [$start_this_month, $end_this_month])->count();
$past_month=Warehouse_detail::whereBetween('date', [$start_past_month, $end_past_month])->count();

$df_ct_mt_up=0;
$df_ct_mt_down=0;
$m_zero_div=false;
if ($this_month>$past_month) {
  // trend
  $df_ct_month=$this_month-$past_month;
  if ($past_month<1) {
    $m_zero_div=true;
  } else {
    $df_ct_mt_up=number_format((($df_ct_month*100)/$past_month),0);
  }
  
}else{
  if ($past_month<1) {
    $m_zero_div=true;
  } else {
    $df_ct_month=$past_month-$this_month;
    $df_ct_mt_down=number_format((($df_ct_month*100)/$past_month),0); // %
  }
}
  //Months Transection

  // Total Transection
  $total_tran = Warehouse_detail::all()->count();
  // Total Transection

@endphp
@section('body')
	<!-- page content -->
	<div class="right_col" role="main">
        <!-- top tiles -->
        <div class="row" style="display: inline-block;" >
        	<div class="tile_count">
            <a href="{{route('materials.index')}}">
            	<div class="col-md-2 col-sm-4  tile_stats_count pr-4 pl-4 text-center">
              		<span class="count_top">
              			<i class="fa fa-cubes" aria-hidden="true"></i>
						          Total Material
					        </span>
              <div class="count">{{$count_items}}</div>
                {{-- <span class="count_bottom"><i class="green">4% </i> From last Week</span> --}}
              </div>
            </a>
            <div class="col-md-2 col-sm-4  tile_stats_count pr-4 pl-4 text-center">
              <span class="count_top"><i class="fa fa-clock-o"></i> Totay Transection</span>
              <div class="count">{{$today_transection}}</div>
              @if($d_zero_div)
                invalid:ref
              @else
              <span class="count_bottom"><i class="@if($df_ct_ps_up>$df_ct_ps_down) green @else red @endif">
                @if($df_ct_ps_up>$df_ct_ps_down)
                <i class="fa fa-sort-asc"></i>{{$df_ct_ps_up}}% </i>
                @else
                <i class="fa fa-sort-desc"></i>{{$df_ct_ps_down}}% </i>
                @endif
                 From Yesterday
               </span>
               @endif
            </div>

            <div class="col-md-2 col-sm-4  tile_stats_count pr-4 pl-4 text-center">
              <span class="count_top"><i class="fa fa-clock-o"></i> Week Transection</span>
              <div class="count">{{$this_week}}</div>
              @if($w_zero_div)
                invalid:ref
              @else
              <span class="count_bottom"><i class="@if($df_ct_wk_up>$df_ct_wk_down) green @else red @endif">
                @if($df_ct_wk_up>$df_ct_wk_down)
                <i class="fa fa-sort-asc"></i>{{$df_ct_wk_up}}% </i>
                @else
                <i class="fa fa-sort-desc"></i>{{$df_ct_wk_down}}% </i>
                @endif
                 From Yesterday
               </span>
               @endif
            </div>

            <div class="col-md-2 col-sm-4  tile_stats_count pr-4 pl-4 text-center">
              <span class="count_top"><i class="fa fa-clock-o"></i> Month Transection</span>
              <div class="count">{{$this_month}}</div>
              @if($m_zero_div)
                invalid:ref
              @else
              <span class="count_bottom"><i class=" @if($df_ct_mt_up>$df_ct_mt_down) green @else red @endif">
              @if($df_ct_mt_up>$df_ct_mt_down)
                <i class="fa fa-sort-asc"></i>{{$df_ct_mt_up}}% </i>
                @else
                <i class="fa fa-sort-desc"></i>{{$df_ct_mt_down}}% </i>
                @endif
              </i> From last Week</span>
              @endif
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count pr-4 pl-4 text-center">
              <span class="count_top"><i class="fa fa-clock-o"></i> Total Transection</span>
              <div class="count">{{$total_tran}}</div>
{{--               <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> --}}
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count pr-4 pl-4 text-center">
              <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
              <div class="count">7,325</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
          </div>
        </div>
          <!-- /top tiles -->
	</div>
@endsection