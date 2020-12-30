@extends('production.warehouse.master')

@section('body')
	<!-- page content -->
	<div class="right_col" role="main">
	    <div class="page-title">
	      <div class="title_left">
	        <h3>Warehouse <small>Materials List</small></h3>
	      </div>

	      <div class="title_right">

	        <div class="col-md-1 col-sm-1 col-xs-1 form-group pull-right top_search bg-dark">
	          <div class="input-group">
	            {{-- <input type="text" class="form-control" placeholder="Search for..."> --}}
	      
	            <span class="input-group-btn">
	              <button class="btn btn-secondary" type="button">Go!</button>
	            </span>
	          </div>
	        </div>
	      </div>
	    </div>
	</div>
@endsection