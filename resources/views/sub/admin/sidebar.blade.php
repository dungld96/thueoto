<!--BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
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
        <li class="{{ request()->is('admin/approve*') || request()->is('admin/trips*') ? 'active open' : '' }}">
          <a href="javascript:;">
          <i class="fas fa-list-alt"></i>
          <span class="title">Quản lý chuyến xe</span>
          @if (request()->is('admin/approve*') || request()->is('admin/trips*'))
            <span class="selected"></span>
          @endif
          {{-- <span class="arrow"></span> --}}
          </a>
          <ul class="sub-menu">
            <li class="{{request()->is('admin/trips') ? 'active' : ''}}">
              <a href="{{route('trips.list')}}">
              <i class="fas fa-suitcase-rolling"></i>
              Danh sách chuyến xe</a>
            </li>
            <li class="{{request()->is('admin/approve/booking') ? 'active' : ''}}">
              <a href="{{route('booking.list')}}">
              <i class="fas fa-clipboard-check"></i>
              Xác nhận đặt xe</a>
            </li>
            <li class="{{request()->is('admin/approve/return') ? 'active' : ''}}">
              <a href="{{route('return.list')}}">
              <i class="fas fa-exchange-alt"></i>
              Xác nhận trả xe</a>
            </li>
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
            <li class="{{request()->is('admin/cars') ? 'active' : ''}}">
              <a href="{{route('admin_cars_index')}}">
              <i class="fas fa-car"></i>
              Danh mục xe</a>
            </li>
            <li class="{{request()->is('admin/customers') ? 'active' : ''}}">
              <a href="{{route('customer.list')}}">
              <i class="fas fa-users"></i>
              Danh mục khách hàng</a>
            </li>
            <li>
              <a href="javascript:;">
              <i class="icon-tag"></i>
              Danh mục giảm giá</a>
            </li>
            {{-- <li>
              <a href="javascript:;">
              <i class="icon-handbag"></i>
              Danh mục giảm giá</a>
            </li> --}}
          </ul>
        </li>
        <li>
          <a href="javascript:;">
          <i class="fas fa-cogs"></i>
          <span class="title">Quản trị hệ thống</span>
          <span class="arrow "></span>
          </a>
          <ul class="sub-menu">
            {{-- <li>
              <a href="javascript:;">
              <i class="icon-home"></i>
              Người dùng</a>
            </li> --}}
            <li>
              <a href="javascript:;">
              <i class="fas fa-tools"></i>
              Tham số hệ thống</a>
            </li>
          </ul>
        </li>
      </ul>
      <!-- END SIDEBAR MENU -->
    </div>
  </div>
  <!-- END SIDEBAR