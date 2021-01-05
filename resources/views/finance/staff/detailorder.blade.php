@extends('finance.staff.master')

@section('body')
@php
use App\Order_detail;
use App\Order;
use App\Supplier;
use App\Warehouse;
use App\Account;
use App\Account_detail
@endphp

     <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Order Detail</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Order Detail</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="  invoice-header">
                          <h6 style="margin-left: 15px;">
                              @foreach($order->detail as $data)
                              @php
                                $warehouse=Warehouse::find($data->warehouse_id);
                              @endphp
                              <small><b>Order Date: {{$order->date}}</b></small><br>
                              <small><b>Order ID:{{$order->id}}</b></small><br>
                              <small><b>Total Price : $ {{$order->total}}</b></small><br>
                            
                          </h6>
                        </div>
                        <!-- /.col -->
                      </div>
                      
                      </div>
                      <!-- /.row -->
                     
                           
                      <!-- Table row -->
                      <div class="row">
                        <div class="  table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th class="align-middle text-center">Product</th>
                                <th class="align-middle text-center">Code No</th>
                                <th class="align-middle text-center">Supplier</th>
                                <th class="align-middle text-center">Qty</th>
                                <th class="align-middle text-center">Unit</th>
                                <th class="align-middle text-center">Price</th>
                                <th class="align-middle text-center">Action</th>

                              </tr>
                            </thead>
                            <tbody>
                              
                              @php                                
                              $amt = number_format($data->qty*$data->price,2);  
                                  $p_orders=Order::where('status_id','>',3)->orderBy('id','desc')->get();

                                  $change=0;
                                  foreach ($p_orders as $p_order) {

                                      $p_order_detail=Order_detail::where('order_id','=',$p_order->id)
                                          ->where('warehouse_id','=',$data->warehouse_id)
                                          ->first();
                                      if ($p_order_detail) {
                                      
                                      if ($p_order_detail->price) {
                                          $change=$p_order_detail['price']-$data->price;
                                      }
                                    }
                                  }
                    
                              @endphp
                              <tr>
                                <td class="align-middle text-center">{{$warehouse->name}}</td>
                                <td class="align-middle text-center">{{$warehouse->codeno}}</td>
                                
                                <td class="align-middle text-center">{{$order->supplier->company_name}}</td>
                                <td class="align-middle text-right">{{$data->qty}}</td>
                                <td class="align-middle text-left">{{$data->UOM}}</td>
                                <td class="align-middle text-left">{{$data->price}}</td>
                                <td class="align-middle text-center">
                                 @if($change<0)
                                  <span class="mr-2"><i class="icofont-caret-up text-danger icofont-2x"></i> <span class="text text-danger">
                                  @php
                                    $change=abs($change);
                                    $change=number_format($change,2);
                                  @endphp
                                  +{{$change}}
                                  </span></span>
                                  @elseif($change>0)
                                  <span class="mr-2"><i class="icofont-caret-down text-success icofont-2x"></i> <span class="text text-success">
                                  @php
                                    $change=abs($change);
                                    $change=number_format($change,2);
                                  @endphp
                                  -{{$change}}
                                  </span></span>
                                  @else
                                  <span class="mr-2"><i class="icofont-minus"></i> 0.00</span>
                                  @endif
                                    <div id="wp2{{$data->id}}" class="float-right pr-5">
                                      
                                      <button id="edo{{$data->id}}" onclick="select('#edo{{$data->id}}','edit1')" style="border-radius: 20px" class="btn btn-success edit">Submit</button>
                                    </div>
                                 
                                </td>
                              </tr>
                             @endforeach
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-md-4 col-sm-4">
                          Please Select Bank
                        <select class="form-control" id="bank" name="bankname">
                          <option>Choose option</option>
                          @foreach($account as $account)
                          @if($account->id!=1)
                            <option id={{$account->id}}>
                              {{$account->bank}}</option>
                          @endif
                          @endforeach
                        </select>
                        
                      </div>
                      <br>
                      </div>
                      <div class="col-md-3">
                          Cheque No
                          <input type="number" class="form-control" id="cheque" name="cheque">
                          </div>
                        </div>
                        <form id="demo-form2" action="{{route('finance.staff.order.update')}}"method="POST"data-parsley-validate class="form-horizontal form-label-left">
                          @csrf
                            @method('GET')
                            <input type="hidden" name="id" value="{{$order->id}}">
                            <input type="hidden" name="balance" value="{{$order->total}}">
                            <input type="hidden" name="account" value="{{$account->id}}">
                            
                      <!-- /.row -->
                    </section>
                    <div class="pt-3">
                      <button onclick="document.getElementById('demo-form2').submit();" class="btn btn-success pull-right">Approve</button>
                      </div>
                  </div>
                </div>

              </div>

            </div>
          </div>

        </div>
        <!-- /page content -->


@endsection