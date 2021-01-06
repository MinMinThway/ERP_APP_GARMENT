@extends('finance.staff.master')
@php
use App\Warehouse;
use App\Warehouse_detail;
use App\Account_detail;
use App\Order;
use App\Account;
  
  
  $transaction_count=Account_detail::all()->sum('outcome');
  
  


  date_default_timezone_set("Asia/Rangoon");
  $todayDate = date('Y-m-d',strtotime('today'));


  $yesterday = date('Y-m-d',strtotime('Yesterday'));
  $today_transection=Account_detail::where('date','=',$todayDate)->sum('outcome');
   
  $yesterday_transection=Account_detail::where('date','=',$yesterday)->sum('outcome');
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

  $this_week=Account_detail::whereBetween('date', [$start, $end])->sum('outcome');
  $past_week=Account_detail::whereBetween('date', [$startp, $endp])->sum('outcome');
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

$this_month=Account_detail::whereBetween('date', [$start_this_month, $end_this_month])->sum('outcome');
$past_month=Account_detail::whereBetween('date', [$start_past_month, $end_past_month])->sum('outcome');

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
  $total_tran = Account_detail::select('outcome')->whereNotNull('outcome')->count();
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
                      Total Expenditure
                  </span>
              <div class="count">{{$transaction_count}}</div>
                {{-- <span class="count_bottom"><i class="green">4% </i> From last Week</span> --}}
              </div>
            </a>
            <div class="col-md-2 col-sm-4  tile_stats_count pr-4 pl-4 text-center">
              <span class="count_top"><i class="fa fa-clock-o"></i> Today Expenditure</span>
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
              <span class="count_top"><i class="fa fa-clock-o"></i> Week Expenditure</span>
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
              <span class="count_top"><i class="fa fa-clock-o"></i> Month Expenditure</span>
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
            <div class="col-md-2 col-sm-4  tile_stats_count pr-4 pl-4 text-center" >
              <span class="count_top"><i class="fa fa-user"></i> Other</span>
              <div class="count">00</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
              <span></span>
            </div>
          </div>
        </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Network Activities <small>Graph title sub-title</small></h3>
                  </div>
                  <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                  </div>
                </div>

                <div class="col-md-9 col-sm-9 ">
                  <div id="chart_plot_01" class="demo-placeholder"></div>
                </div>
                <div class="col-md-3 col-sm-3  bg-white">
                  <div class="x_title">
                    <h2>Top Campaign Performance</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="col-md-12 col-sm-12 ">
                    <div>
                      <p>Facebook Campaign</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Twitter Campaign</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 ">
                    <div>
                      <p>Conventional Media</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Bill boards</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>
  
@endsection
{{-- 
@section('script')
$.ajax({
    type:"POST",
    url:"getEarning.php",
    success:function(response)
    {
      // console.log(response);
      var earningresult = JSON.parse(response);

      console.log(earningresult);
      var data = {
          labels: ["January", "February", "March", "April", "May", "June","July",
            "August","September","October","November","December"],
        datasets: [
          {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor:   "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [earningresult[0],earningresult[1],earningresult[2],
            earningresult[3],earningresult[4],earningresult[5],earningresult[6],earningresult[7],
            earningresult[8],earningresult[9],earningresult[10],earningresult[11]]
          }
        ]
      };

      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(data);

    }

  })

  });
@endsection --}}