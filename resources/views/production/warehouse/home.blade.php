@extends('production.warehouse.master')
@php
use App\Warehouse;
use App\Warehouse_detail;
  // Total Material
  $count_items=Warehouse::all()->count();
  // Today Transection
  date_default_timezone_set("Asia/Rangoon");
  $todayDate = date('Y-m-d',strtotime('today'));
  $yesterday = date('Y-m-d',strtotime('Yesterday'));
  $today_transection=Warehouse_detail::where('date','=',$todayDate)->count();
  $yesterday_transection=Warehouse_detail::where('date','=',$yesterday)->count();
  $df_ct_ps_up=0;
  $df_ct_ps_down=0;
  if ($today_transection>$yesterday_transection) {
    // trend
    $df_ct_day=$today_transection-$yesterday_transection;
    $df_ct_ps_up=number_format((($df_ct_day*100)/$yesterday_transection),0);
  }else{
    $df_ct_day=$yesterday_transection-$today_transection;
    $df_ct_ps_down=number_format(($df_ct_day*100)/$yesterday_transection,0);
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
  if ($this_week>$past_week) {
    // trend
    $df_ct_week=$this_week-$past_week;
    $df_ct_wk_up=number_format((($df_ct_week*100)/$past_week),0);
  }else{
    $df_ct_week=$past_week-$this_week;
    $df_ct_wk_down=number_format((($df_ct_week*100)/$past_week),0);
  }
  // week Transection
  //Months Transection
  $m=strtotime('today');
  $start_month=strtotime('-1 Months');
  $end_month=strtotime('today');
  $startm=date('Y-m-d',$start_month);
  $endm=date('Y-m-d',$end_month);

  //Past months

  $start_monthp=strtotime('-2 Months');
  $end_monthp=strtotime('-1 Months');
  $startmp=date('Y-m-d',$start_monthp);
  $endmp=date('Y-m-d',$end_monthp);

  // var_dump($startmp);
  // var_dump($endmp).die();
 //past month

 $this_month=Warehouse_detail::whereBetween('date', [$startm, $endm])->count();
 $past_month=Warehouse_detail::whereBetween('date', [$startmp, $endmp])->count();

$df_ct_mt_up=0;
$df_ct_mt_down=0;
if ($this_month>$past_month) {
  // trend
  $df_ct_month=$this_month-$past_month;
  $df_ct_mt_up=number_format((($df_ct_month*100)/$past_month),0);
}else{
  $df_ct_month=$past_month-$this_month;
  $df_ct_mt_down=number_format((($df_ct_month*100)/$past_month),0);
}

  //Months Transection

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
              <span class="count_bottom"><i class="@if($df_ct_ps_up>$df_ct_ps_down) green @else red @endif">
                @if($df_ct_ps_up>$df_ct_ps_down)
                <i class="fa fa-sort-asc"></i>{{$df_ct_ps_up}}% </i>
                @else
                <i class="fa fa-sort-desc"></i>{{$df_ct_ps_down}}% </i>
                @endif
                 From Yesterday</span>
            </div>

            <div class="col-md-2 col-sm-4  tile_stats_count pr-4 pl-4 text-center">
              <span class="count_top"><i class="fa fa-clock-o"></i> Week Transection</span>
              <div class="count">{{$this_week}}</div>
              <span class="count_bottom"><i class="@if($df_ct_wk_up>$df_ct_wk_down) green @else red @endif">
                @if($df_ct_wk_up>$df_ct_wk_down)
                <i class="fa fa-sort-asc"></i>{{$df_ct_wk_up}}% </i>
                @else
                <i class="fa fa-sort-desc"></i>{{$df_ct_wk_down}}% </i>
                @endif
                 From Yesterday</span>
            </div>

            <div class="col-md-2 col-sm-4  tile_stats_count pr-4 pl-4 text-center">
              <span class="count_top"><i class="fa fa-user"></i> Month Transection</span>
              <div class="count">{{$this_month}}</div>
              <span class="count_bottom"><i class=" @if($df_ct_mt_up>$df_ct_mt_down) green @else red @endif">
              @if($df_ct_mt_up>$df_ct_mt_down)
                <i class="fa fa-sort-asc"></i>{{$df_ct_mt_up}}% </i>
                @else
                <i class="fa fa-sort-desc"></i>{{$df_ct_mt_down}}% </i>
                @endif
              </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count pr-4 pl-4 text-center">
              <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
              <div class="count">2,315</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
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