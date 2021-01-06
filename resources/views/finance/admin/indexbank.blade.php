@extends('finance.admin.master')

@section('body')
 <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Account Lists</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
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
	
     <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Accounts</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Bank Name</th>
                          <th>Account Type</th>
                          <th>Account Number</th>
                          <th>Balance</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                      	@php $i=1; @endphp
                  
                        @foreach($accounts as $account)
                          @if($account->id!=1)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{$account->bank}}</td>
                          <td>{{$account->type}}</td>
                          <td>{{$account->acc_number}}</td>
                          <td>${{$account->balance}}</td>
                        </tr>
                          @endif
                        @endforeach
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
              
@endsection