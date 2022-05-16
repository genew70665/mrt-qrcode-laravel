<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->segment('2') == 'dashboard' ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>Dashboard</p>
            </a>
        </li> 
        @can('isAdmin')
            <li class="nav-item has-treeview {{ request()->segment('2') == 'admin' ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->segment('2') == 'admin' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Admin Management
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.index') }}" class="nav-link {{ request()->segment('2') == 'admin' && request()->segment('3') == '' ? 'active' : '' }}">
                            <p>View</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.create') }}" class="nav-link {{ request()->segment('2') == 'admin' && request()->segment('3') == 'create' ? 'active' : '' }}">
                            <p>Add</p>
                        </a>
                    </li>
                </ul>
            </li> 
        @endcan
        <li class="nav-item has-treeview {{ request()->segment('2') == 'users' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->segment('2') == 'users' ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>Users Management
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->segment('2') == 'users' && request()->segment('3') == '' ? 'active' : '' }}">
                        <p>View</p>
                    </a>
                </li>
            </ul>
        </li> 
        <li class="nav-item has-treeview {{ request()->segment('2') == 'equipment' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->segment('2') == 'equipment' ? 'active' : '' }}">
                <i class="nav-icon fas fa-vial"></i>
                <p>Equipment Management
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('equipment.index') }}" class="nav-link {{ request()->segment('2') == 'equipment' && request()->segment('3') == '' ? 'active' : '' }}">
                        <p>View</p>
                    </a>
                </li>
            </ul>
        </li> 
        <li class="nav-item has-treeview {{ request()->segment('2') == 'kit' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->segment('2') == 'kit' ? 'active' : '' }}">
                <i class="nav-icon fas fa-wine-bottle"></i>
                <p>Kit Management
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('kit.index') }}" class="nav-link {{ request()->segment('2') == 'kit' && request()->segment('3') == '' ? 'active' : '' }}">
                        <p>View</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kit.create') }}" class="nav-link {{ request()->segment('2') == 'kit' && request()->segment('3') == 'create' ? 'active' : '' }}">
                        <p>Add</p>
                    </a>
                </li>
            </ul>
        </li> 
    </ul>
</nav>
<!-- /.sidebar-menu -->