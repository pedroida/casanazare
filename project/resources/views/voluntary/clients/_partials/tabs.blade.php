<nav class="nav nav-pills">
    <a class="nav-link {{ is_active('voluntary.acolhidos.index', 'active', true) }}"
        href="{{ route('voluntary.acolhidos.index') }}">
        <i class="fas fa-user-shield fa-fw mr-2"></i>@lang('headings.clients.index')
    </a>

    <a class="nav-link {{ is_active('voluntary.acolhidos.forbidden', 'active', true) }}"
        href="{{ route('voluntary.acolhidos.forbidden') }}">
    <i class="fas fa-user-friends fa-fw mr-2"></i>@lang('headings.clients.forbidden_index')
    </a>
</nav>