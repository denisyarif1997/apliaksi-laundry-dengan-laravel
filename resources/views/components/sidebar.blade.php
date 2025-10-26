<nav class="mt-1">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>

        @role('admin')
            {{-- Master Data submenu --}}
            <li class="nav-item has-treeview {{ (Route::is('admin.user.*') || Route::is('admin.role.*') || Route::is('admin.permission.*') || Route::is('admin.customer.*') || Route::is('admin.services.*')) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ (Route::is('admin.user.*') || Route::is('admin.role.*') || Route::is('admin.permission.*') || Route::is('admin.customer.*') || Route::is('admin.services.*')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-layer-group"></i>
                    <p>
                        Master Data
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.user.index') }}" class="nav-link {{ Route::is('admin.user.*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Users <span class="badge badge-info right">{{ $userCount }}</span></p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.role.index') }}" class="nav-link {{ Route::is('admin.role.*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Roles <span class="badge badge-success right">{{ $RoleCount }}</span></p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.permission.index') }}" class="nav-link {{ Route::is('admin.permission.*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Permissions <span class="badge badge-danger right">{{ $PermissionCount }}</span></p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.customer.index') }}" class="nav-link {{ Route::is('admin.customer.*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Customers <span class="badge badge-warning right">{{ $CustomerCount }}</span></p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.services.index') }}" class="nav-link {{ Route::is('admin.services.*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Layanan <span class="badge badge-primary right">{{ $ServicesCount }}</span></p>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Transactions submenu --}}
            <li class="nav-item has-treeview {{ Route::is('admin.transaction.*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ Route::is('admin.transaction.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-exchange-alt"></i>
                    <p>
                        Transactions
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.transaction.index') }}" class="nav-link {{ Route::is('admin.transaction.index') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Transactions <span class="badge badge-primary right">{{ $TransactionCount }}</span></p>
                        </a>
                    </li>
                    {{-- add more transaction-related links here if needed --}}
                </ul>
            </li>
        @endrole

        <li class="nav-item">
            <a href="{{ route('admin.profile.edit') }}" class="nav-link {{ Route::is('admin.profile.edit') ? 'active' : '' }}">
                <i class="nav-icon fas fa-id-card"></i>
                <p>Profile</p>
            </a>
        </li>

    </ul>
</nav>
