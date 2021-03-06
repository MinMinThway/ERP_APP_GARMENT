@extends('finance.staff.master')
@php
use App\Warehouse;
use App\Warehouse_detail;
use App\Account_detail;
use App\Order;
use App\Account;
  

  $transaction_count=Account_detail::all()->sum((int)('outcome'));
  

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
  $mp = strtotime("first day of this Month");
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

//year transection
// $start_this_year=date('Y-m-d',strtotime('first day of this Year'));
// $end_this_year=date('Y-m-d',strtotime('last day of this Year',strtotime("+334 days")));

// //var_dump($end_this_year);
// $start_past_year=date('Y-m-d',strtotime('first day of this Month',strtotime("-12 month")));
// $end_past_year=date('Y-m-d',strtotime('last day of this Month',strtotime("-1 month")));

// // var_dump($end_past_year);
// $this_year=Account_detail::whereBetween('date', [$start_this_year, $end_this_year])->sum('outcome');
// $past_year=Account_detail::whereBetween('date', [$start_past_year, $end_past_year])->sum('outcome');

// $df_ct_ye_up=0;
// $df_ct_ye_down=0;
// $ye_zero_div=false;

// if($this_year>$past_year){

//   $dt_ct_year=$this_year-$past_year;
//   if($past_year<1) {
//     $ye_zero_div=true;
//   } else{
//       $dt_ct_ye_up=number_format((($df_ct_year*100)/$past_year),0);
//   }

//   }else{
//     if ($past_year<1) {
//       $ye_zero_div=true;
//     } else{
//       $dt_ct_year=$past_year-$this_year;
//       $df_ct_ye_down=number_format((($dt_ct_year*100)/$past_year),0);
    
//   }
// }


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
            <div class="col-md-3 col-sm-4  tile_stats_count pr-4 pl-4 text-center">
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
              </i> From last Month</span>
              @endif
            </div>
            {{-- <div class="col-md-2 col-sm-4  tile_stats_count pr-4 pl-4 text-center">
              <span class="count_top"><i class="fa fa-clock-o"></i> Year Expenditure</span>
              <div class="count">{{$this_year}}</div>
              @if($ye_zero_div)
                invalid:ref
              @else
              <span class="count_bottom"><i class=" @if($df_ct_ye_up>$df_ct_ye_down) green @else red @endif">
              @if($df_ct_ye_up>$df_ct_ye_down)
                <i class="fa fa-sort-asc"></i>{{$df_ct_ye_up}}% </i>
                @else
                <i class="fa fa-sort-desc"></i>{{$df_ct_ye_down}}% </i>
                @endif
              </i> From last Year</span>
              @endif
            </div> --}}

            <div class="col-md-3 col-sm-4  tile_stats_count pr-4 pl-4 text-center">
              <span class="count_top"><i class="fa fa-clock-o"></i> Total Transection</span>
              <div class="count">{{$total_tran}}</div>
{{--               <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> --}}
            </div>
            
          </div>
        </div>
        <h3 class="tile-title">Banks And Amounts</h3>
        <div class="x_content">
                    <div class="row">
                       @foreach($account as $account)
                       @if($account->id!=1)
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><a href="="><i class="fa fa-credit-card" style="size: 20px;"></i></a>
                          </div>
                          <div class="count"><small>{{$account->bank}}</small></div>
                            <h4 style="margin-left: 10px;"><b>$ {{$account->balance}}</b></h4>

                              
                          </div>
                          @if($account->balance < 2000)
                              
                                <p style="color:red"><b>Please fill the amount for {{$account->bank}} Bank*</b></p>
                              @endif
                        </div>
                       @endif
                      @endforeach
                    </div>
                    </div>
          <!-- /top tiles -->
          
             

        


         

          <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Week Transection</h3>
                    <div class="embed-responsive embed-responsive-16by9">
                        <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
                    </div>
                </div>
            </div>
    </div>

    
                  
                  
   
  </div>
  

                

@endsection
@section('script')
<script type="text/javascript" src="{{asset('js/plugins/chart.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method:"GET",
        url: '{{route('acearning')}}',
        success:function(x){
            var send = JSON.parse(x);
            
            var data = {
            labels: [send[7],send[8],send[9],send[10],send[11],send[12],send[13]],
            datasets: [
              {
                label: "",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(253,0,0,1)",
                data: [ send[0],send[1],send[2],send[3],send[4],send[5],send[6]]
              }
            ]
          };
          
          var ctxl = $("#lineChartDemo").get(0).getContext("2d");
          var lineChart = new Chart(ctxl).Line(data);
        }
    })
</script>
@endsection