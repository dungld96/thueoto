<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
  <!-- BEGIN HEADER INNER -->
  <div class="page-header-inner">
    <!-- BEGIN LOGO -->
    <div class="page-logo">
      <a href="#">
        VT
      </a>
      <div class="menu-toggler sidebar-toggler hide">
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
        <!-- BEGIN INBOX DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
          <i class="icon-envelope-open"></i>
          <span class="badge badge-default">
          2 </span>
          </a>
          <ul class="dropdown-menu">
            <li class="external">
              <h3>You have <span class="bold">2 New</span> Messages</h3>
              <a href="page_inbox.html">view all</a>
            </li>
            <li>
              <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                <li>
                  <a href="inbox.html?a=view">
                  <span class="photo">
                  <img src="{{asset('assets/admin/layout3/img/avatar2.jpg')}}" class="img-circle" alt="">
                  </span>
                  <span class="subject">
                  <span class="from">
                  Lisa Wong </span>
                  <span class="time">Just Now </span>
                  </span>
                  <span class="message">
                  Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                  </a>
                </li>
                <li>
                  <a href="inbox.html?a=view">
                  <span class="photo">
                  <img src="{{asset('assets/admin/layout3/img/avatar3.jpg')}}" class="img-circle" alt="">
                  </span>
                  <span class="subject">
                  <span class="from">
                  Richard Doe </span>
                  <span class="time">16 mins </span>
                  </span>
                  <span class="message">
                  Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <!-- END INBOX DROPDOWN -->
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
              <a href="extra_profile.html">
              <i class="icon-user"></i> My Profile </a>
            </li>
            <li>
              <a href="inbox.html">
              <i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger">
              3 </span>
              </a>
            </li>
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