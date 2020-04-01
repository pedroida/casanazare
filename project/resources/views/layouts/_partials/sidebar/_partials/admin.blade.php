<ul class="sidebar-menu">
  <li class="menu-header">Dashboard</li>
  <li class="{{ request()->is('home*', '/') ? 'active' : null }}">
    <a class="nav-link" href="{{ route('home') }}" data-toggle="tooltip" data-placement="right" title="Dashboard Geral">
      <i class="fas fa-fire"></i>
      <span>Dashboard Geral</span>
    </a>
  </li>

  <li class="menu-header">@lang('headings.common.registration')</li>
  @if(current_user()->can('users list admin'))
    <li class="{{ is_active(['admin.administradores.index', 'admin.acolhidos.index']) }}">
      <a class="nav-link" href="{{ route('admin.administradores.index') }}" data-toggle="tooltip" data-placement="right"
         title="@lang('headings.common.users')">
        <i class="fas fa-users"></i>
        <span>@lang('headings.common.users')</span>
      </a>
    </li>
  @endif
</ul>