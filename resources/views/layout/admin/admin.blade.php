<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Vĩnh Tín Auto | @yield('title')</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<meta name="_token" content="{{csrf_token()}}" />
<link rel="shortcut icon" href="favicon.ico"/>
@include('sub.admin.style')
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid">
@include('sub.admin.header')
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
  @include('sub.admin.sidebar')
  <!-- BEGIN CONTENT -->
  <div class="page-content-wrapper">
    <div class="page-content">
    	<!-- BEGIN PAGE HEADER-->
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="#">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">@yield('title')</a>
					</li>
				</ul>
			</div>
			
		<!-- END PAGE HEADER-->
     @yield('content')
    </div>
  </div>
  <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
@include('sub.admin.footer')
@include('sub.admin.scripts')
</body>
<!-- END BODY -->
</html>