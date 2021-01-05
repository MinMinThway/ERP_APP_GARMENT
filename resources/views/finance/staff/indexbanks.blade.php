@extends('finance.staff.master')

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
                      <li><a href="{{route('account.create')}}"><i class="fa fa-plus-circle fa-lg"> Add</i></a>
                    </li>
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
                          <th>Action</th>
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
                          <td>
                          	<a href="{{route('account.edit',$account->id)}}" class="btn btn-primary btn-sm" alt="Edit"><i class="fa fa-edit"></i></a>
                        <form method="post" action="{{route('account.destroy',$account->id)}}" onsubmit="return confirm('Are you sure?')" class="d-inline">
                              @csrf
                        @method('DELETE')

                          <button type="submit" class="btn btn-danger btn-sm" name="btnsubmit" value="Delete"><i class="fa fa-trash"></i></button></td>
                        </tr>
                          @endif
                        @endforeach
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
              
@endsection