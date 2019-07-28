@extends('layout.admin.admin')
@section('title', 'Dashboard')
@section('style-page')
    <link href="{{asset('assets/global/plugins/dropzone/css/dropzone.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="row content-header">
        <div class="col-md-8">
            <h3 class="page-title">
                Dashboard
            </h3>
        </div>
        <div class="col-md-4">
           
        </div>
    </div>
    <!-- BEGIN DASHBOARD STATS -->
			<div class="row">
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat blue-madison">
              <div class="visual">
                <i class="fa fa-comments"></i>
              </div>
              <div class="details">
                <div class="number">
                   1349
                </div>
                <div class="desc">
                   Khách hàng
                </div>
              </div>
              <a class="more" href="javascript:;">
              Xem thêm <i class="m-icon-swapright m-icon-white"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat red-intense">
              <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
              </div>
              <div class="details">
                <div class="number">
                   12,5M đ
                </div>
                <div class="desc">
                   Doanh thu
                </div>
              </div>
              <a class="more" href="javascript:;">
              Xem thêm <i class="m-icon-swapright m-icon-white"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat green-haze">
              <div class="visual">
                <i class="fa fa-shopping-cart"></i>
              </div>
              <div class="details">
                <div class="number">
                   549
                </div>
                <div class="desc">
                  Chuyến xe trong tháng
                </div>
              </div>
              <a class="more" href="javascript:;">
              Xem thêm <i class="m-icon-swapright m-icon-white"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat purple-plum">
              <div class="visual">
                <i class="fa fa-globe"></i>
              </div>
              <div class="details">
                <div class="number">
                   +89%
                </div>
                <div class="desc">
                   Chuyến xe thành công
                </div>
              </div>
              <a class="more" href="javascript:;">
              Xem thêm <i class="m-icon-swapright m-icon-white"></i>
              </a>
            </div>
          </div>
        </div>
        <!-- END DASHBOARD STATS -->
   
@endsection
