<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header">
        <a href="{{ url('/dashboard') }}" class="b-brand text-dark d-flex align-items-center justify-content-center" style="width: 100%; min-height: 60px;">
            <span class="fw-bold text-uppercase ls-1 text-center" style="font-size: 1rem;">
                <img src="{{ asset("template/assets/img/logo.jpeg") }}" alt="Logo" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                {{ env("APP_NAME") }}
            </span>
        </a>
    </div>
    
    <hr style="margin: 0 15px; border-top: 1px solid #b6a598da; opacity: 1;">

    <div class="navbar-content">
      <ul class="pc-navbar">
        
        @foreach ($routes as $route)
          @if (!$route["is_dropdown"])
            <li class="pc-item {{ request()->routeIs($route['route_active']) || request()->is($route['route_active']) ? 'active' : '' }}">
              <a href="{{ route($route['route_name']) }}" class="pc-link">
                <span class="pc-micon"><i class="{{ $route['icon'] }}"></i></span>
                <span class="pc-mtext">{{ $route['label'] }}</span>
              </a>
            </li>
          @else
            <li class="pc-item pc-hasmenu {{ request()->routeIs($route['route_active']) || request()->is($route['route_active']) || request()->is($route['route_active'].'/*') ? 'pc-trigger active' : '' }}">
              <a href="#!" class="pc-link">
                <span class="pc-micon"><i class="{{ $route['icon'] }}"></i></span>
                <span class="pc-mtext">{{ $route['label'] }}</span>
                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
              </a>
              <ul class="pc-submenu">
                @foreach ($route["dropdown"] as $item)
                  <li class="pc-item {{ request()->routeIs($item['route_active']) || request()->is($item['route_active']) ? 'active' : '' }}">
                    <a class="pc-link" href="{{ route($item['route_name']) }}">
                      {{ $item['label'] }}
                    </a>
                  </li>
                @endforeach
              </ul>
            </li>
          @endif
        @endforeach

      </ul>
      </div>
  </div>
</nav>