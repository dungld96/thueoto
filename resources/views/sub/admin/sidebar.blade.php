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

        <li class="{{ request()->is('admin/cars*') || request()->is('admin/customers*') || request()->is('admin/coupons*')? 'active open' : '' }}">
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
            <li class="{{request()->is('admin/coupons') ? 'active' : ''}}">
              <a href="{{route('coupons.list')}}">
              <i class="icon-tag"></i>
              Danh mục giảm giá</a>
            </li>
            <li class="{{request()->is('admin/cars/models') ? 'active' : ''}}">
              <a href="{{route('cars.models.list')}}">
              <i class="fas fa-box"></i>
              Danh mục mẫu xe</a>
            </li>
          </ul>
        </li>
        @if (Auth::user()->isAdmin())
        <li class="{{ request()->is('admin/users*') || request()->is('admin/customers*') ? 'active open' : '' }}">
          <a href="javascript:;">
          <i class="fas fa-cogs"></i>
          <span class="title">Quản trị hệ thống</span>
          </a>
          <ul class="sub-menu">
            <li class="{{request()->is('admin/users') ? 'active' : ''}}">
              <a href="{{route('users.list')}}">
              <i class="fas fa-users-cog"></i>
              Người dùng</a>
            </li>
            <li class="{{request()->is('admin/configs') ? 'active' : ''}}">
              <a href="{{route('admin.configs')}}">
              <i class="fas fa-tools"></i>
              Tham số hệ thống</a>
            </li>
          </ul>
        </li>
        @endif
      </ul>
      <!-- END SIDEBAR MENU -->
    </div>
  </div>
  <!-- END SIDEBAR