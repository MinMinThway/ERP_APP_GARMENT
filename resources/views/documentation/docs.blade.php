<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Documentation for ERP project</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Bootstrap 4 Template For Software Startups">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome JS-->
    <script defer src="{{asset('assets/fontawesome/js/all.min.js')}}"></script>
    
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.2/styles/atom-one-dark.min.css">

    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="{{asset('assets/css/theme.css')}}">

</head> 

<body class="docs-page">    
    <header class="header fixed-top">	    
        <div class="branding docs-branding">
            <div class="container-fluid position-relative py-2">
                <div class="docs-logo-wrapper">
					<button id="docs-sidebar-toggler" class="docs-sidebar-toggler docs-sidebar-visible mr-2 d-xl-none" type="button">
	                    <span></span>
	                    <span></span>
	                    <span></span>
	                </button>
	                <div class="site-logo"><a class="navbar-brand" href="index.html"><span class="logo-text">ERP<span class="text-alt">Software For Garment</span></span></a></div>    
                </div><!--//docs-logo-wrapper-->
	            <div class="docs-top-utilities d-flex justify-content-end align-items-center">
	
					<ul class="social-list list-inline mx-md-3 mx-lg-5 mb-0 d-none d-lg-flex">
						<li class="list-inline-item"><a href="https://github.com/arkarMannAung">
							<i class="fab fa-github fa-fw"></i></a>
						</li>
			            <li class="list-inline-item"><a href="#">
			            	<i class="fab fa-twitter fa-fw"></i></a>
			            </li>
		                <li class="list-inline-item"><a href="#">
		                	<i class="fab fa-slack fa-fw"></i></a>
		                </li>
		                <li class="list-inline-item"><a href="#">
		                	<i class="fab fa-product-hunt fa-fw"></i></a>
		                </li>
		            </ul><!--//social-list-->

		            <a href="{{route('welcome')}}" class="mr-5">login</a>
	            </div><!--//docs-top-utilities-->
            </div><!--//container-->
        </div><!--//branding-->
    </header><!--//header-->
    
    <div class="docs-wrapper">
	    <div id="docs-sidebar" class="docs-sidebar">
		    <div class="top-search-box d-lg-none p-3">
                <form class="search-form">
		            <input type="text" placeholder="Search the docs..." name="search" class="form-control search-input">
		            <button type="submit" class="btn search-btn" value="Search"><i class="fas fa-search"></i></button>
		        </form>
            </div>
		    <nav id="docs-nav" class="docs-nav navbar">
			    <ul class="section-items list-unstyled nav flex-column pb-3">
				    <li class="nav-item section-title"><a class="nav-link scrollto active" href="#section-1"><span class="theme-icon-holder mr-2"><i class="fas fa-map-signs"></i></span>Introduction</a></li>

				    <li class="nav-item"><a class="nav-link scrollto" href="#item-1-1">Team Member</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-1-2">Problem Statement</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-1-3">Entity Relationship Diagram</a></li>

				    <li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-2"><span class="theme-icon-holder mr-2"><i class="fas fa-arrow-down"></i></span>Authentication</a></li>

				    <li class="nav-item"><a class="nav-link scrollto" href="#item-2-1">Database Considerations</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-2-2">Routing</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-2-3">Authenticating</a></li>

				    <li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-4"><span class="theme-icon-holder mr-2"><i class="fas fa-cogs"></i></span>Function</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-4-1">Reorder Date Calculation</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-4-2">Standard Deviation</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-4-3">Order Panel</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-4-4">Procurement Panel</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-4-5">Finance Panel</a>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-4-6">Notification</a>
			    </ul>

		    </nav><!--//docs-nav-->
	    </div><!--//docs-sidebar-->
	    <div class="docs-content">
		    <div class="container">
			    <article class="docs-article" id="section-1">
				    <header class="docs-header">
					    <h1 class="docs-heading">Introduction <span class="docs-time">Last updated: 2021-01-07</span></h1>
					    <section class="docs-intro">
						    <p style="line-height: 50px;text-align: justify;">ကျနော်တို့ Creative Youth Developer Group မှနေပြီးတော့ ဆွေးနွေးဆုံးဖြတ်ထားတဲ့ project ကတော့ Ordering for Garment Web application ဖြစ်ပါတယ် အထည်ချုပ်စက်ရုံတစ်ခုရဲ့ ပစ္စည်းမှာယူရေးဟာ ထုတ်လုပ်ရေး၊ ကုန်ကြမ်းဝယ်ယူရေးနှင့် ဘဏ္ဍာရေးဆိုင်ရာ စိစစ်ခြင်းစတဲ့အပိုင်းတွေနဲ့ ပါဝင်ပါတ်သက်နေပါတယ်။ ဒီ project ဟာဆိုရင် Enterprise Resource Planning (ERP) ကိုချဉ်းကပ်တဲ့ Organization တစ်ခုရဲ့ ဌာနတစ်ခုနှင့်တစ်ခု ချိတ်ဆက်ရာမှာ မှန်ကန်တဲ့ သတင်းအချက်အလက်တွေကို analysis လုပ်နိုင်ဖို့အတွက်ဒီ app ထောက်ပံ့ပေးသွားမှာဖြစ်ပါတယ်။</p>
						</section><!--//docs-intro-->		
				    </header>

				    <section class="docs-section" id="item-1-1">
						<h2 class="section-heading py-3">Team Member</h2>
						<div class="row justify-content-center">
							<div class="col col-sm-12 col-md-4 ">
								<img src="{{asset('logo/Arkar Mann Aung.jpg')}}" class="rounded-circle mx-auto d-block" width="250px">
								<h3 class="text-center mt-5">ARKAR MANN AUNG</h1>
								<a class="text-center nav-link" href="http://arkarmannaung.me/">visit</a>
							</div>
							<div class="col col-sm-12 col-md-4">
								<img src="{{asset('logo/min min thway.jpg')}}" class="rounded-circle mx-auto d-block" width="250px">
								<h3 class="text-center mt-5">MIN MIN THWAY</h1>
								<a class="text-center nav-link" href="http://minminthway.me">visit</a>
							</div>
							<div class="col col-sm-12 col-md-4">
								<img src="{{asset('logo/Hinin Htet Hmuu Khin.jpg')}}" class="rounded-circle mx-auto d-block" width="250px">
								<h3 class="text-center mt-5">HNIN THET HMUU KHIN</h1>
								<a class="text-center nav-link" href="http://hninthethmukhin.me/">visit</a>
							</div>
						</div>
						<p> </p>	
                        
					</section><!--//section-->
					
					<section class="docs-section" id="item-1-2">
						<h2 class="section-heading">Problem Statement</h2>
						<p style="line-height: 50px;text-align: justify;">ကုန်ကြမ်းမပြတ်လပ်ရေးဟာ ထုတ်လုပ်ရေး လုပ်ငန်းတင်သာမက အခြားသော ကုန်ပစ္စည်းရောင်းဝယ်ရာတွင်လည်း အလွန်ရေးကြီးတဲ့အချက်ဖြစ်ပါတယ်။ပစ္စည်းပြတ်လပ်မှုဟာ ထုတ်ကုန်လုပ်ငန်းမှာ လုပ်ငန်းလည်ပတ်မှုကို အနှောက်အယှက်ဖြစ်စေသလို ဖြန့်ဖြူးရောင်းချရေးလုပ်ငန်းတွေမှာဆိုရင် ဖောက်သည်တွေရဲ့ satisfaction level ကိုထိခိုက်စေနိုင်ပါတယ်။ဒါကြောင့် ထုတ်လုပ်ရေးဌာနအနေနဲ့ ကုန်ကြမ်းများကို stock အတွင်းမ ပြတ်လပ်စေပဲ မှာယူရမည့်ရက်ကို ခန့်မှန်းတွက်ချက်ပေးမှာဖြစ်ပါတယ်။ ထုတ်လုပ်ရေးဌာနမှ ကုန်ပစ္စည်း order များကို ဝယ်ယူရေးဌာနမှ ဈေးများစုံစမ်းထည့်သွင်းခြင်း၊ suplier အချက်အလက်များ ဖြည့်သွင်းပြီးနောက် ငွေစာရင်းဌာနသို့ ငွေတောင်းခံခြင်းများကို web မှတစ်ဆင့်ဆောင်ရွက်နိုင်မည်ဖြစ်ပါသည်။ ငွေစာရင်းဌာနမှ ဘဏ္ဍာရေးဆိုင်ရာစိစစ်နိုင်ရန် ယခင်မှာယူခဲ့ဖူးသော order များမှ ဈေးနှုန်းများနှင့် နှိုင်းယှဉ်ပြခြင်းနှင့် ငွေစာရင်းများ ထည့်သွင်းတွက်ချက်နိုင်မည်ဖြစ်ပါသည်။</p>
						
					</section><!--//section-->
					
					<section class="docs-section" id="item-1-3">
						<h2 class="section-heading">Entity Relationship Diagram</h2>
						<div class="row">
							<div class="col col-12">
								<img src="{{asset('logo/ERD.jpg')}}" class="img-fluid">	
							</div>
						</div>
						
					</section><!--//section-->
					
			    </article>
			    
			    <article class="docs-article" id="section-2">
				    <header class="docs-header">
					    <h1 class="docs-heading">Authentication With Laravel 7</h1>
					    <section class="docs-intro">
						    <p>Laravel makes implementing authentication very simple. In fact, almost everything is configured for you out of the box. The authentication configuration file is located at config/auth.php, which contains several well documented options for tweaking the behavior of the authentication services.</p>
						    <h2>Account List</h2>
						    <div class="container">
							    <table class="table table-responsive" width="100%">
							    	<thead class="badge-dark">
							    		<tr>
							    			<th width="10%">no</th>
							    			<th width="25%">name</th>
							    			<th width="20%">password</th>
							    			<th width="25%">department</th>
							    			<th width="20%">role</th>
							    		</tr>
							    	</thead>

							    	<tbody>
							    		<tr>
							    			<th>1</th>
							    			<th>production@warehouse.com</th>
							    			<th>password</th>
							    			<th>production</th>
							    			<th>store keeper</th>
							    		</tr>
							   			<tr>
							    			<th>2</th>
							    			<th>production@staff.com</th>
							    			<th>password</th>
							    			<th>production</th>
							    			<th>staff</th>
							    		</tr>
							   			<tr>
							    			<th>3</th>
							    			<th>production@admin.com</th>
							    			<th>password</th>
							    			<th>production</th>
							    			<th>staff</th>
							    		</tr>
							   			<tr>
							    			<th>4</th>
							    			<th>procurement@staff.com</th>
							    			<th>password</th>
							    			<th>procurement</th>
							    			<th>staff</th>
							    		</tr>
							   			<tr>
							    			<th>5</th>
							    			<th>procurement@admin.com</th>
							    			<th>password</th>
							    			<th>procurement</th>
							    			<th>admin</th>
							    		</tr>
							   			<tr>
							    			<th>6</th>
							    			<th>finance@staff.com</th>
							    			<th>password</th>
							    			<th>finance</th>
							    			<th>staff</th>
							    		</tr>
							   			<tr>
							    			<th>7</th>
							    			<th>finance@admin.com</th>
							    			<th>password</th>
							    			<th>finance</th>
							    			<th>admin</th>
							    		</tr>
							    	</tbody>						    	
							    </table>
						    </div>
						</section><!--//docs-intro-->
				    </header>
				     <section class="docs-section" id="item-2-1">
						<h2 class="section-heading">Database Considerations</h2>
						<p>By default, Laravel includes an App\User Eloquent model in your app directory. This model may be used with the default Eloquent authentication driver. If your application is not using Eloquent, you may use the database authentication driver which uses the Laravel query builder.</p>
					</section><!--//section-->
					
					<section class="docs-section" id="item-2-2">
						<h2 class="section-heading">Routing</h2>
						<p>Laravel's laravel/ui package provides a quick way to scaffold all of the routes and views you need for authentication using a few simple commands:

composer require laravel/ui:^2.4

php artisan ui vue --auth

This command should be used on fresh applications and will install a layout view, registration and login views, as well as routes for all authentication end-points. A HomeController will also be generated to handle post-login requests to your application's dashboard.</p>
					</section><!--//section-->
					<section class="docs-section" id="item-2-3">
						<h2 class="section-heading">Authenticating</h2>
						<p>Now that you have routes and views setup for the included authentication controllers, you are ready to register and authenticate new users for your application! You may access your application in a browser since the authentication controllers already contain the logic (via their traits) to authenticate existing users and store new users in the database.</p>
					</section><!--//section-->
			    </article><!--//docs-article-->
			    		    
			    <article class="docs-article" id="section-4">
				    <header class="docs-header">
					    <h1 class="docs-heading">Function</h1>
					    <section class="docs-intro">
						    <p style="line-height: 50px;text-align: justify;">ကုန်ပစ္စည်းများ၏အချက်အလက်များကို warehouse ထဲမှာ register ပြုလုပ်နိုင်ပြီး နေ့စဉ် အဝင်အထွက်များကို မှတ်တမ်းပြုစုရမှာဖြစ်ပါတယ်။ထိုမှတ်တမ်းများမှတစ်ဆင့် ကုန်ပစ္စည်းတစ်ခုချင်းအလိုက် တစ်ရက်ပျမ်းမျှ အချက်အလက်များရရှိပါမည်။ ကုန်ပစ္စည်းတိုင်းတွင် lead Time ကိုသတ်မှတ်ပေးနိုင်မည်ဖြစ်ပြီး safety factor ကို လိုအပ်သလိုထည့်သွင်းနိုင်ပါမည်။ကုန်ပစ္စည်းများ၏ ပျမ်းမျှခြင်းများမှတစ်ဆင့် ကုန်ဆုံးမည့်ရက်ကို ခန့်မှန်းရာတွင် စံကွဲလွဲနှုန်း standard deviation သည်များစွာ ပါတ်သက်နေသည့်အတွက် population mean နဲ့ standard deviation ကို production staff panel တွင်ထည့်သွင်းပေးထားပါသည်။warehouse တွင် order delivery invoice လက်ခံရရှိကြောင်း အတည်ပြုလိုက်သည်နှင့် ထို order စတင်မှာယူသည့်ရက်မှ ရောက်ရှိသည့်နေ့ရက်အထိ ကြာချိန်(lead time) အား တွက်ချက်ပြီး updated ပြုလုပ်သွားမည်ဖြစ်ပါသည်။Stock Safe တွက်ချက်ရာတွင် ပျမ်းမျှ daily output ကိုအခြေခံကာ တွက်ချက်ထားသဖြင့် စံကွဲလွဲမှု့နှုန်းများလေလေ ခန့်မှန်းမှု့တိကျမှု့နဲလေလေဖြစ်ရာ stock safe ဖြစ်နိုင်စေရန် ကွဲလွဲမှု့များသော ပစ္စည်းများကို safety factor တိုးယူနိုင်ရန်အတွက် အကြံပြုပါသည်။.</p>
						</section><!--//docs-intro-->
				    </header>
				     <section class="docs-section" id="item-4-1">
						<h2 class="section-heading">Reorder Date Calculation</h2>
						<img src="{{asset('logo/panel1.jpg')}}" class="img-fluid py-5">
					</section><!--//section-->

				     <section class="docs-section" id="item-4-2">
						<h2 class="section-heading">Standard Deviation</h2>
						<img src="{{asset('logo/panel2.jpg')}}" class="img-fluid py-5">
					</section><!--//section-->

				     <section class="docs-section" id="item-4-3">
						<h2 class="section-heading">Order Panel</h2>
						<img src="{{asset('logo/panel3.jpg')}}" class="img-fluid py-5">
					</section><!--//section-->
					
					<section class="docs-section" id="item-4-4">
						<h2 class="section-heading">Procurement Panel</h2>
						<img src="{{asset('logo/panel4.jpg')}}" class="img-fluid py-5">
					</section><!--//section-->

					<section class="docs-section" id="item-4-5">
						<h2 class="section-heading">Finance Panel</h2>
						<img src="{{asset('logo/panel5.jpg')}}" class="img-fluid py-5">
					</section><!--//section-->

					<section class="docs-section" id="item-4-6">
						<h2 class="section-heading">Notification</h2>
						<img src="{{asset('logo/panel6.jpg')}}" class="img-fluid py-5">
					</section><!--//section-->
			    </article><!--//docs-article-->

			    <footer class="footer">
				    <div class="container text-center py-5">
					    <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
				        <small class="copyright">Thank You <a class="theme-link" href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley </a> Your Template Designed is cute <i class="fas fa-heart" style="color: #fb866a;"></i> like you!</small>
				        <ul class="social-list list-unstyled pt-4 mb-0">
						    <li class="list-inline-item"><a href="#"><i class="fab fa-github fa-fw"></i></a></li> 
				            <li class="list-inline-item"><a href="#"><i class="fab fa-twitter fa-fw"></i></a></li>
				            <li class="list-inline-item"><a href="#"><i class="fab fa-slack fa-fw"></i></a></li>
				            <li class="list-inline-item"><a href="#"><i class="fab fa-product-hunt fa-fw"></i></a></li>
				            <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f fa-fw"></i></a></li>
				            <li class="list-inline-item"><a href="#"><i class="fab fa-instagram fa-fw"></i></a></li>
				        </ul><!--//social-list-->
				    </div>
			    </footer>
		    </div> 
	    </div>
    </div><!--//docs-wrapper-->
    
   
       
    <!-- Javascript -->          
    <script src="{{asset('assets/plugins/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('assets/plugins/popper.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>  
    
    
    <!-- Page Specific JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/highlight.min.js"></script>
    <script src="{{asset('assets/js/highlight-custom.js')}}"></script> 
    <script src="{{asset('assets/plugins/jquery.scrollTo.min.js')}}"></script>
    <script src="{{asset('assets/plugins/lightbox/dist/ekko-lightbox.min.js')}}"></script> 
    <script src="{{asset('assets/js/docs.js')}}"></script> 

</body>
</html> 

