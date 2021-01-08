<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>ERP Software</title>
    
    
    <link rel="stylesheet" type="text/css" href="{{asset('icon/icofont/icofont.min.css')}}">
    <link href="{{asset('vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
    <!-- Ion.RangeSlider -->
    <link href="{{asset('vendors/normalize-css/normalize.css')}}" rel="stylesheet">

    <link href="{{asset('vendors/ion.rangeSlider/css/ion.rangeSlider.css')}}" rel="stylesheet">

    <link href="{{asset('vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">

    <!-- Bootstrap Colorpicker -->
    <link href="{{asset('vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">

    <link href="{{asset('vendors/cropper/dist/cropper.min.css')}}" rel="stylesheet">

   <link href="{{asset('vendors/fontawesome/css/font-awesome.css')}}" rel="stylesheet">
    
    <!-- Bootstrap -->
    <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
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
                <span>Finance Staff</span>
                @guest
                    <h2> guest</h2>
                @else
                    <h2>{{Auth::user()->name}}</h2>
                @endguest

              </div>
            </div>
            <!-- /menu profile quick info -->

            <br/>
            {{-- slide bar menu --}}
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="{{route('finance.staff.home')}}"><i class="fa fa-dashboard pr-2" style="font-size: 20px"></i>Dashboard</a></li>
                </ul>
              </div>

              <div class="menu_section">
                <h3>Finance</h3>
                <ul class="nav side-menu">
                  <li><a href="{{route('account.index')}}"><i class="fa fa-institution pr-2" style="font-size: 20px"></i>Bank Accounts</a>
                  </li>
                  <li><a href="{{route('account.newbudget')}}"><i class="fa fa-money"></i>Budgets</a>
                  </li>
                </ul>
              </div>

              <div class="menu_section">
                <h3>Orders</h3>
                <ul class="nav side-menu">
                  <li><a href="{{route('finance.staff.order')}}"><i class="fa fa-inbox pr-2" style="font-size: 20px"></i> Orders Page <span class="label label-success pull-right"></span></a></li>
                    </ul>
              </div>
                  <div class="menu_section">
                <h3>Balance</h3>
                <ul class="nav side-menu">
                   <li><a href="{{route('finance.staff.searchbalancesheet')}}"><i class="fa fa-file-text-o pr-2" style="font-size: 20px"></i>Balance Sheet</a>
                   </li>
                   <li class="{{ Request::is('finance/staff/history*') ? 'current-page' : '' }}">
                      <a href="{{route('staff_4_history')}}">
                        <i class="icofont-history pr-2" style="font-size: 20px"></i>
                      Order History
                      </a>

                      
                      </li>

                </ul>
              </div>

              <div class="menu_section">
                <h3>Reports</h3>
                <ul class="nav side-menu">
                  </li>
                  <li><a href="{{route('finance.staff.searchreport')}}"><i class="fa fa-file-archive-o pr-2" style="font-size: 20px"></i>Daily Report</a>
                  </li>
                  <li><a href="{{route('finance.staff.monthlysearchreport')}}"><i class="fa fa-file pr-2" style="font-size: 20px"></i>Monthly Report</a>
                  </li>
                  <li><a href="{{route('finance.staff.yearlysearchreport')}}"><i class="fa fa-file-text pr-2" style="font-size: 20px"></i>Yearly Report</a>
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
                              <a href="{{route('staff_2_history')}}">
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
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
 <!-- jquery.inputmask -->
    <script src="{{asset('vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>

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
    <script src="{{asset('build/js/custom.min.js')}}"></script>
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
        data:{opt:'>',state:1},
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
              if (v.status==2) {
                var title='Order Request #ERP'+v.id;
              }else if (v.status==3) {
                var title='Report Recieved! #ERP'+v.id;
              }else if (v.status==4) {
                var title='Finance #ERP'+v.id;
              }else if (v.status==6) {
                var title='Approved! #ERP'+v.id;
              }else if (v.status==8) {
                var title='delivery! #ERP'+v.id;
              }else{
                notforyou=false;
              }
              // title status
              // title status
              if (v.status==2) {
                var body='Plz set price form director(production)';
              }else if (v.status==3) {
                var body='i will be check! director(procurement)';
              }else if (v.status==4) {
                var body='your order total= '+v.total+'$ is recieved!';
              }else if (v.status==6) {
                var body='Your order is approve by finance';
              }else if (v.status==8) {
                var body='i recieved all item from warehouse';
              }else{
              }
              // title status


              if ($i>4) {
              }else{
              if (notforyou) {
                html+=` <li class="nav-item bg-gray">
                          <form id="info${v.id}" action="{{route('order_4_info')}}" method="POST" class="d-none">
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