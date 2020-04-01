<nav class="nav nav-pills">
    <a class="nav-link {{ is_active('admin.administradores.index', 'active', true) }}"
        href="{{ route('admin.administradores.index') }}">
        <i class="fas fa-user-shield fa-fw mr-2"></i>@lang('headings.admin-users.label')
    </a>

    <a class="nav-link {{ is_active('admin.voluntarios.index', 'active', true) }}"
        href="{{ route('admin.voluntarios.index') }}">
        <i class="fas fa-user-friends fa-fw mr-2"></i>@lang('headings.voluntary-users.label')
    </a>
</nav>