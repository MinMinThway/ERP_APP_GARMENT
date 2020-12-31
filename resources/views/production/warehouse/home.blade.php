@extends('production.warehouse.master')
@php
use App\Warehouse;
  $count_items=Warehouse::all()->count();
@endphp
@section('body')
	<!-- page content -->
	<div class="right_col" role="main">
        <!-- top tiles -->
        <div class="row" style="display: inline-block;" >
        	<div class="tile_count">
            <a href="{{route('materials.index')}}">
            	<div class="col-md-2 col-sm-4  tile_stats_count">
              		<span class="count_top">
              			<i class="fa fa-cubes" aria-hidden="true"></i>
						          Total Material
					        </span>
              <div class="count">{{$count_items}}</div>
                <span class="count_bottom"><i class="green">4% </i> From last Week</span>
              </div>
            </a>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>
              <div class="count">123.50</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
              <div class="count green">2,500</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
              <div class="count">4,567</div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
              <div class="count">2,315</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
              <div class="count">7,325</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
          </div>
        </div>
          <!-- /top tiles -->
	</div>
@endsection