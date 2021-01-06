@extends('finance.admin.master')
@php
use App\Order_detail;
use App\Order;
@endphp
@section('body')

  <!-- page content -->
  <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Reports</h3>
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="x_panel">
                <div class="x_title">


                  <h2>Monthly Reports</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a href="{{route('finance.admin.home')}}"><i class="fa fa-reply"> Back</i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  
                  <form id="demo-form2" action="{{route('finance.admin.monthlyreport')}}" data-parsley-validate class="form-horizontal form-label-left">
                    @csrf
                    <label class="col-form-label col-md-3 col-sm-3 "> <h6><b>Please select Month <span class="required">*</span></b></h6>
                      </label>
                      <div class="col-md-4 col-sm-4 ">
                        <input class="date-picker form-control" placeholder="mm-yyyy" type="text" name="month" required="required" type="month" onfocus="this.type='month'" onmouseover="this.type='month'" onclick="this.type='month'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                        <script>
                          function timeFunctionLong(input) {
                            setTimeout(function() {
                              input.type = 'text';
                            }, 60000);
                          }
                        </script>
                      </div>
                      <br>
                      <br><br>
                    <div class="item form-group">
                      <div class="col-md-6 col-sm-6 offset-md-3">
                        <button type="submit" class="btn btn-success" name="submit">Search</button>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
  </div>
  
@endsection