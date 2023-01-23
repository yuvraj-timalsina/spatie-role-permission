<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
@canany(['user-index', 'user-create','user-edit','user-delete'])
    <li class="nav-item">
        <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('*users*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>User</p>
        </a>
    </li>
@endcan
@canany(['role-index','role-create','role-edit','role-delete'])
    <li class="nav-item">
        <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('*roles*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            <p>Role</p>
        </a>
    </li>
@endcan
<li class="nav-item">
    <a href="{{ route('todos.index') }}" class="nav-link {{ Request::is('*todos*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-clipboard"></i>
        <p>Todo</p>
    </a>
</li>
