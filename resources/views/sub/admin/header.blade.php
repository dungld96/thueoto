<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
  <!-- BEGIN HEADER INNER -->
  <div class="page-header-inner">
    <!-- BEGIN LOGO -->
    <div class="page-logo">
      <a href="{{route('dashboard')}}">
        VT
      </a>
      <div class="menu-toggler sidebar-toggler">
      </div>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
    </a>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <!-- BEGIN TOP NAVIGATION MENU -->
    <div class="top-menu">
      <ul class="nav navbar-nav pull-right">
        <!-- BEGIN NOTIFICATION DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
          <i class="icon-bell"></i>
          <span class="badge badge-default">
          1 </span>
          </a>
          <ul class="dropdown-menu">
            <li class="external">
              <h3><span class="bold">1 pending</span> notifications</h3>
              <a href="extra_profile.html">view all</a>
            </li>
            <li>
              <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                <li>
                  <a href="javascript:;">
                  <span class="time">just now</span>
                  <span class="details">
                  <span class="label label-sm label-icon label-success">
                  <i class="fa fa-plus"></i>
                  </span>
                  New user registered. </span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <!-- END NOTIFICATION DROPDOWN -->
        <!-- BEGIN USER LOGIN DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <li class="dropdown dropdown-user">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
          <img alt="" class="img-circle" src="{{asset('assets/admin/layout/img/avatar3_small.jpg')}}"/>
          <span class="username username-hide-on-mobile">
          {{Auth::user()->name}} </span>
          <i class="fa fa-angle-down"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-default">
            <li>
              <a href="{{route('users.changepassword')}}">
              <i class="icon-user"></i> Đổi mật khẩu </a>
            </li>
            {{-- <li>
              <a href="inbox.html">
              <i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger">
              3 </span>
              </a>
            </li> --}}
            <li class="divider">
            </li>
            <li>
              <a href="{{route('user.logout')}}">
              <i class="icon-key"></i> Log Out </a>
            </li>
          </ul>
        </li>
        <!-- END USER LOGIN DROPDOWN -->
        
      </ul>
    </div>
    <!-- END TOP NAVIGATION MENU -->
  </div>
  <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->