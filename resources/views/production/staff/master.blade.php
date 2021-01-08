<!DOCTYPE html>
<html lang="en">
  <head>
    @php
      date_default_timezone_set("Asia/Rangoon");
    @endphp
    <meta name="csrf-token" content="{{ csrf_token() }}">  
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>ERP Software</title>
    {{-- icofont --}}
    <link rel="stylesheet" type="text/css" href="{{asset('icon/icofont/icofont.min.css')}}">

    <!-- Bootstrap -->
    {{-- <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet"> --}}
    <link href="{{asset('vendors/bootstrap4/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/bootstrap4/bootstrap.min.js')}}" rel="stylesheet">
    <!-- Datatables -->    
    <link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/fontawesome/css/font-awesome.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="{{asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>ERP Software</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{asset('logo/erp.png')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>User Name</span>
                @guest
                    <h2> guest</h2>
                @else
                    <h2>{{Auth::user()->name}}</h2>
                @endguest

              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />
            {{-- slide bar menu --}}
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">       
                  <li class="{{ Request::is('production/staff/home') ? 'current-page' : '' }}">
                    <a href="{{route('production.staff.home')}}">
                      <i class="icofont-dashboard pr-2" style="font-size: 20px"></i>
                    Dashboard 
                    </a>
                  </li>
{{--                    <li class="{{ Request::is('production/warehouse/materials*') ? 'current-page' : '' }}">
                    <a href="{{route('materials.index')}}">
                      <i class="fa fa-database" aria-hidden="true"></i>
                    Materials
                    </a>
                  </li> --}}

                  <li class="{{ Request::is('production/staff/inventory*') ? 'current-page' : '' }}">
                    <a href="{{route('analysis')}}">
                      <i class="icofont-chart-line-alt pr-2" style="font-size: 20px"></i>
                     Inventory Analysis
                    </a>
                  </li>

                 <li class="{{ Request::is('production/staff/report*') ? 'current-page' : '' }}">
                    <a href="{{route('production.staff.report')}}">
                      <i class="icofont-safety pr-2" style="font-size: 20px"></i>
                    Stock Safe
                    </a>
                  </li>

                 <li class="{{ Request::is('production/staff/order*') ? 'current-page' : '' }}">
                    <a href="{{route('production.staff.order')}}">
                      <i class="icofont-ui-cart pr-2" style="font-size: 20px"></i>
                    Create Order
                    </a>
                  </li>

                  <li class="{{ Request::is('production/staff/history*') ? 'current-page' : '' }}">
                    <a href="{{route('staff_0_history')}}">
                      <i class="icofont-history pr-2" style="font-size: 20px"></i>
                    Order History
                    </a>
                  </li>

                </ul>
              </div>
            </div>
            {{-- slide bar menu --}}

            {{-- sidebar-footer --}}
                <div class="sidebar-footer hidden-small">
                  <a data-toggle="tooltip" data-placement="top" title="Settings">
                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                  </a>
                  <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                    <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                  </a>
                  <a data-toggle="tooltip" data-placement="top" title="Lock">
                    <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                  </a>
                  <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                  </a>
                </div>
            {{-- sidebar-footer --}}

          </div>
        </div>

        {{-- top-nav --}} 
            <div class="top_nav">
              <div class="nav_menu">
                  <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                  </div>
                  <nav class="nav navbar-nav">
                  <ul class=" navbar-right">
                    <li class="nav-item dropdown open" style="padding-left: 15px;">
                      <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset('logo/erp.png')}}" alt="">{{Auth::user()->email}}
                      </a>
                      <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"  href="javascript:;"> Profile</a>
                          <a class="dropdown-item"  href="javascript:;">
                            <span class="badge bg-red pull-right">50%</span>
                            <span>Settings</span>
                          </a>
                      <a class="dropdown-item"  href="javascript:;">Help</a>
                        <a class="dropdown-item"  href="{{ route('logout') }}" onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right" ></i> Log Out</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                      </div>
                    </li>

                    <li role="presentation" class="nav-item dropdown open">
                      <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span id="count" class="badge bg-green"></span>
                      </a>
                      <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">

                        <div id="message">
                        </div>
                        
                        <li class="nav-item">
                          <div class="text-center">
                            <a class="dropdown-item">
                              <a href="{{route('staff_0_history')}}">
                              <strong>See More</strong>
                              </a>
                              <i class="fa fa-angle-right"></i>
                            </a>
                          </div>
                        </li>

                      </ul>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>

        {{-- top-nav --}}

        @yield('body')

        <footer>
          <div class="pull-right">
            ERP Application for Garment Industry <a href="javascript:void(0)">Team@CYD</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer  content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{asset('vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{asset('vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{asset('vendors/skycons/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{asset('vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{asset('vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{asset('vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{asset('vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{asset('vendors/DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{asset('vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{asset('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{asset('build/js/custom.js')}}"></script>
    @yield('script')
  </body>
</html>

<script type="text/javascript">
  var old=false,seen=false;
  var count=0;
  $(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#navbarDropdown1').click(function(){
      seen=true;
    })
    var test=setInterval(noti,3000);
    function noti(){
      $.ajax({
        url:"{{route('noti')}}",
        method:'GET',
        data:{opt:'>',state:0},
        success:function(ans){
          var now=JSON.parse(ans);
          var d = new Date();
          var n = Math.round(d.getTime() / 1000);

            if (!old) {old=now;} // initialized
            if (seen) {
              old=now;
              seen=false;
              count=0;
            }

            if (old) {
              var str_old=JSON.stringify(old);
              var str_now=JSON.stringify(now);
              if (str_old!=str_now) {
                count++;
                old=now;
              }
            }
            $('#count').text(count);
            // clearInterval(test);

            html='';
            var $i=1;

            now.forEach(function(v,i){
              var notforyou=true;
              // time calculation
              var time_diff=Math.abs(v.time-n);
              if (time_diff>86400) {
                var ago=Math.round(time_diff/86400);
                var text=ago+' day ago';
              }else if (time_diff>3600) {
                var ago=Math.round(time_diff/3600);
                var text=ago+' hour ago';
              }else if (time_diff>60) {
                var ago=Math.round(time_diff/60);
                var text=ago+' min ago';
              }else{
                var ago=time_diff;
                var text=ago+' sec ago';
              }
              // time calculation

              // title status
              if (v.status==1) {
                var title='REPORT RECIEVED! #ERP'+v.id;
              }else if (v.status==2) {
                var title='PROCUREMENT #ERP'+v.id;
              }else if (v.status==4) {
                var title='APPROVED! #ERP'+v.id;
              }else if (v.status==6) {
                var title='APPROVED! #ERP'+v.id;
              }else if (v.status==7) {
                var title='SHIPPING! #ERP'+v.id;
              }else if (v.status==8) {
                var title='DELIVERY! #ERP'+v.id;
              }else{
                notforyou=false;
              }
              // title status
              // title status
              if (v.status==1) {
                var body='i will be check! director(production)';
              }else if (v.status==2) {
                var body='your order is recieved! from staff procurement';
              }else if (v.status==4) {
                var body='Your order is approve by procurement';
              }else if (v.status==6) {
                var body='Your order is approve by finance';
              }else if (v.status==7) {
                var body='your order is shipping now!';
              }else if (v.status==8) {
                var body='i recieved all item from warehouse';
              }
              // title status

              if ($i>4) {
              }else{
              if (notforyou) {
                html+=` <li class="nav-item bg-gray">
                          <form id="info${v.id}" action="{{route('order_0_info')}}" method="POST" class="d-none">
                            @csrf
                            @method('GET')
                            <input type="text" name="id" value="${v.id}">
                          </form>
                          <a class="dropdown-item"
                          onclick="event.preventDefault();document.getElementById('info${v.id}').submit();">
                            <span class="image">
                            </span>
                            <span>
                              <span>${title}</span>
                              <span class="time">
                              ${text}
                              </span>
                            </span>
                            <span class="message">
                              ${body}
                            </span>
                          </a>
                        </li>`;
              }
              }
              $i++;           
            })
            $('#message').html(html);
          }

      });
    }

  })
</script>