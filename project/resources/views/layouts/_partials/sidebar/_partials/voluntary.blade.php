<ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="{{ request()->is('home*', '/') ? 'active' : null }}">
        <a class="nav-link" href="{{ route('home') }}" data-toggle="tooltip" data-placement="right"
           title="Dashboard Geral">
            <i class="fas fa-fire"></i>
            <span>Dashboard Geral</span>
        </a>
    </li>

    <li class="menu-header">@lang('headings.common.registration')</li>
    @if(current_user()->can('stays list'))
        <li class="{{ is_active('voluntary.estadias.index') }}">
            <a class="nav-link" href="{{ route('voluntary.estadias.index') }}" data-toggle="tooltip" data-placement="right"
               title="@lang('headings.common.stays')">
                <i class="fas fa-calendar-plus"></i>
                <span>@lang('headings.common.stays')</span>
            </a>
        </li>
    @endif

    @if(current_user()->can('meals list'))
        <li class="{{ is_active('voluntary.refeicoes.index') }}">
            <a class="nav-link" href="{{ route('voluntary.refeicoes.index') }}" data-toggle="tooltip" data-placement="right"
               title="@lang('headings.common.meals')">
                <i class="fas fa-utensils"></i>
                <span>@lang('headings.common.meals')</span>
            </a>
        </li>
    @endif

    @if(current_user()->can('clients list'))
        <li class="{{ is_active('voluntary.acolhidos.index') }}">
            <a class="nav-link" href="{{ route('voluntary.acolhidos.index') }}" data-toggle="tooltip" data-placement="right"
               title="@lang('headings.common.clients')">
                <i class="fas fa-user-plus"></i>
                <span>@lang('headings.common.clients')</span>
            </a>
        </li>
    @endif
</ul>
