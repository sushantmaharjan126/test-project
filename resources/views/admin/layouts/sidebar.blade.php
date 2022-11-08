  <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="{{ url('admin/dashboard') }}" class="app-brand-link">
        <div class="avatar">
            <img src="@if(isset(Auth::guard('admin')->user()->profile_image)) {{ asset('uploads/admins/'.Auth::guard('admin')->user()->profile_image) }} @else {{ url('administration/assets/img/avatars/user.png') }} @endif" alt class="w-px-40 h-auto rounded-circle" />
        </div>
        <span class="app-brand-text demo menu-text fw-bolder ms-2">{{ucwords(config('app.name'))}}</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item <?php if(Request::segment(2) === 'dashboard' || Request::segment(2) == null) { echo 'active'; } ?>">
        <a href="{{ url('admin/dashboard') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>

      <!-- Layouts -->
      <li class="menu-item">
        <a href="{{ url('/') }}" target="_blank" class="menu-link">
          <i class="menu-icon tf-icons bx bx-sitemap"></i>
          <div data-i18n="Layouts">Visit Site</div>
        </a>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Site Management</span>
      </li>
      <li class="menu-item">
        <a href="{{ url('admin/movies') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Account Settings">Movies</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{ url('admin/users') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-user-account"></i>
          <div data-i18n="Authentications">Users</div>
        </a>
      </li>
      <!-- Components -->
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">User Management</span>
      </li>
      <!-- Cards -->
      {{-- <li class="menu-item">
        <a href="cards-basic.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-cog"></i>
          <div data-i18n="Basic">Settings</div>
        </a>
      </li> --}}
      <!-- User interface -->
      <li class="menu-item <?php if(request()->segment(2) === 'admins' || request()->segment(2) === 'admin'){ echo 'active'; } ?>">
        <a href="{{ url('admin/admins') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-user-account"></i>
          <div data-i18n="User interface">Admin</div>
        </a>
      </li>
    </ul>
  </aside>