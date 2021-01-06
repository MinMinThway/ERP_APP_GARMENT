@extends('procurement.staff.master')
@php
use App\Warehouse;
use App\Warehouse_detail;
use App\Order;
  // Total Material
  $count_items=Warehouse::all()->count();
  

  $total_order=Order::where('status_id','>',2)->count();
  date_default_timezone_set("Asia/Rangoon");

  $todayDate = date('Y-m-d',strtotime('today'));
  $today_order=Order::where('status_id','>',2)
            ->where('date','=',$todayDate)
            ->count();

  $d = strtotime("today");
  $start_week = strtotime("last sunday midnight",$d);
  $end_week = strtotime("next saturday",$d);
  $start = date("Y-m-d",$start_week); 
  $end = date("Y-m-d",$end_week);

  $week_order=Order::whereBetween('date', [$start, $end])->count();

  $start_this_month=date('Y-m-d',strtotime('first day of this Month'));
  $end_this_month=date('Y-m-d',strtotime('last day of this Month'));

  $month_order=Order::whereBetween('date', [$start_this_month, $end_this_month])->count();

  $start_this_year=date('Y-m-d',strtotime('first day of January'));
  $end_this_year=date('Y-m-d',strtotime('last day of December'));

  $year_order=Order::whereBetween('date', [$start_this_year, $end_this_year])->count();
@endphp
@section('body')
  <!-- page content -->
  <div class="right_col" role="main">
        <!-- top tiles -->
        <div class="row" style="display: inline-block;" >
          <div class="tile_count">
            {{-- <a href="{{route('materials.index')}}"> --}}
              <div class="col-md-2 col-sm-4  tile_stats_count pr-4 pl-4 text-center">
                  <span class="count_top">
                    <i class="fa fa-cubes" aria-hidden="true"></i>
                      Total Order
                  </span>
              <div class="count">{{$total_order}}</div>
                {{-- <span class="count_bottom"><i class="green">4% </i> From last Week</span> --}}
              </div>
            {{-- </a> --}}
            <div class="col-md-2 col-sm-4  tile_stats_count pr-4 pl-4 text-center">
              <span class="count_top"><i class="fa fa-clock-o"></i> Totay Order</span>
              <div class="count">{{$today_order}}</div>
            </div>

            <div class="col-md-2 col-sm-4  tile_stats_count pr-4 pl-4 text-center">
              <span class="count_top"><i class="fa fa-clock-o"></i> Week Order</span>
              <div class="count">{{$week_order}}</div>
            </div>

            <div class="col-md-2 col-sm-4  tile_stats_count pr-4 pl-4 text-center">
              <span class="count_top"><i class="fa fa-clock-o"></i> Month Order</span>
              <div class="count">{{$month_order}}</div>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count pr-4 pl-4 text-center">
              <span class="count_top"><i class="fa fa-clock-o"></i> Year Order</span>
              <div class="count">{{$year_order}}</div>
            </div>
          </div>
        </div>
          <!-- /top tiles -->

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Total Transection</h3>
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
        url: '{{route('earning4')}}',
        success:function(x){
            var send = JSON.parse(x);
            
            var data = {
            labels: [   "January", "February", "March", "April",
                        "May","Jun","July","August","September",
                        "October","November","December"],
            datasets: [
              {
                label: "",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(253,0,0,1)",
                data: [ send[0],send[1],send[2],send[3],
                        send[4],send[5],send[6],send[7],
                        send[8],send[9],send[10],send[11],]
              }
            ]
          };
          
          var ctxl = $("#lineChartDemo").get(0).getContext("2d");
          var lineChart = new Chart(ctxl).Line(data);
        }
    })
</script>
@endsection