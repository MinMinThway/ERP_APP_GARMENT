@extends('finance.staff.master')
@php
use App\Order_detail;
use App\Order;
use App\Account;
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
                    <li><a href="{{route('finance.staff.home')}}"><i class="fa fa-reply"> Back</i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  
                  <form id="demo-form2" action="{{route('finance.staff.balancesheet')}}" data-parsley-validate class="form-horizontal form-label-left" method="POST">
                    @csrf
                    @method('GET')
                    <label class="col-form-label col-md-3 col-sm-3 "><h6><b>Please select Month <span class="required">*</span></b></h6>
                      </label>
                      <div class="col-md-4 col-sm-4 ">
                        <select class="form-control" id="bank" name="bankname">
                          <option>Choose option</option>
                          @foreach($account as $account)
                          @if($account->id!=1)
                            <option value={{$account->id}}>
                              {{$account->bank}}</option>
                          @endif


                          @endforeach

                        </select>
                        
                      </div>
                      <br>
                      <br><br>
                    <div class="item form-group">
                      <div class="col-md-6 col-sm-6 offset-md-3">
                        <button onclick="document.getElementById('demo-form2').submit();" type="submit" class="btn btn-success" name="submit">Search</button>
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