<!--BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper">
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
      <!-- BEGIN SIDEBAR MENU -->
      <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
      <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
      <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
      <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
      <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
      <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
      <ul class="page-sidebar-menu page-sidebar-menu-closed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="margin-top:40px;">
        
        <li class="start {{ request()->is('admin/dashboard') ? 'active open' : '' }} ">
          <a href="{{route('dashboard')}}">
          <i class="icon-home"></i>
          <span class="title">Dashboard</span>
          @if (request()->is('admin/dashboard'))
            <span class="selected"></span>
          @endif
          </a>
        </li>
        <li class="{{ request()->is('admin/booking*') || request()->is('admin/trips*') ? 'active open' : '' }}">
          <a href="javascript:;">
          <i class="fas fa-list-alt"></i>
          <span class="title">Quản lý chuyến xe</span>
          @if (request()->is('admin/booking*') || request()->is('admin/trips*'))
            <span class="selected"></span>
          @endif
          {{-- <span class="arrow"></span> --}}
          </a>
          <ul class="sub-menu">
            <li class="{{request()->is('admin/booking') ? 'active' : ''}}">
              <a href="{{route('booking.list')}}">
              <i class="fas fa-clipboard-check"></i>
              Chuyến xe chờ duyệt</a>
            </li>
            <li class="{{request()->is('admin/trips') ? 'active' : ''}}">
              <a href="{{route('trips.list')}}">
              <i class="fas fa-suitcase-rolling"></i>
              Danh sách chuyến xe</a>
            </li>
            {{--<li>
              <a href="javascript:;">
              <i class="icon-tag"></i>
              Xe chờ xác nhận</a>
            </li> --}}
          </ul>
        </li>

        <li class="{{ request()->is('admin/cars*') ? 'active open' : '' }}">
          <a href="javascript:;">
          <i class="icon-grid"></i>
          <span class="title">Danh mục</span>
          @if (request()->is('admin/cars*'))
            <span class="selected"></span>
          @endif
          {{-- <span class="arrow"></span> --}}
          </a>
          <ul class="sub-menu">
            {{-- <li>
              <a href="javascript:;">
              <i class="icon-home"></i>
              Danh mục khách hàng</a>
            </li> --}}
            <li class="{{request()->is('admin/cars') ? 'active' : ''}}">
              <a href="{{route('admin_cars_index')}}">
              <i class="fas fa-car"></i>
              Danh mục xe</a>
            </li>
           {{--  <li>
              <a href="javascript:;">
              <i class="icon-tag"></i>
              Danh mục giá</a>
            </li>
            <li>
              <a href="javascript:;">
              <i class="icon-handbag"></i>
              Danh mục giảm giá</a>
            </li> --}}
          </ul>
        </li>
       {{--  <li>
          <a href="javascript:;">
          <i class="icon-basket"></i>
          <span class="title">Quản trị hệ thống</span>
          <span class="arrow "></span>
          </a>
          <ul class="sub-menu">
            <li>
              <a href="javascript:;">
              <i class="icon-home"></i>
              Người dùng</a>
            </li>
            <li>
              <a href="javascript:;">
              <i class="icon-basket"></i>
              Tham số hệ thống</a>
            </li>
          </ul>
        </li> --}}
      </ul>
      <!-- END SIDEBAR MENU -->
    </div>
  </div>
  <!-- END SIDEBAR