<nav class="mt-3">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!-- Dashboard -->
        <li class="nav-item mb-2">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>Dashboard</p>
            </a>
        </li>

        @role('admin')
            <!-- Master Data -->
            <li class="nav-item has-treeview {{ (Route::is('admin.user.*') || Route::is('admin.role.*') || Route::is('admin.permission.*')|| Route::is('admin.mesincuci.*') || Route::is('admin.item.*') || Route::is('admin.customer.*') || Route::is('admin.services.*') ||Route::is('admin.company.*') || Route::is('admin.backup.*')) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ (Route::is('admin.user.*') || Route::is('admin.role.*') || Route::is('admin.permission.*') || Route::is('admin.mesincuci.*') || Route::is('admin.item.*') || Route::is('admin.customer.*') || Route::is('admin.services.*') || Route::is('admin.company.*') || Route::is('admin.backup.*')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-database"></i>
                    <p>
                        Data Master
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.company.index') }}" class="nav-link {{ Route::is('admin.company.*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon text-xs"></i>
                            <p>Master Laundry</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.customer.index') }}" class="nav-link {{ Route::is('admin.customer.*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon text-xs"></i>
                            <p>
                                Pelanggan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.services.index') }}" class="nav-link {{ Route::is('admin.services.*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon text-xs"></i>
                            <p>
                                Layanan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.item.index') }}" class="nav-link {{ Route::is('admin.item.*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon text-xs"></i>
                            <p>
                                Barang
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.mesincuci.index') }}" class="nav-link {{ Route::is('admin.mesincuci.*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon text-xs"></i>
                            <p>
                                Mesin Laundry
                            </p>
                        </a>
                    </li>
                    
                    <!-- Divider -->
                    <li class="nav-header" style="font-size: 0.7rem; opacity: 0.5;">SISTEM</li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.user.index') }}" class="nav-link {{ Route::is('admin.user.*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon text-xs"></i>
                            <p>
                                Users
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.role.index') }}" class="nav-link {{ Route::is('admin.role.*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon text-xs"></i>
                            <p>
                                Role
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.permission.index') }}" class="nav-link {{ Route::is('admin.permission.*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon text-xs"></i>
                            <p>
                                permission
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.backup.index') }}" class="nav-link {{ Route::is('admin.backup.*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon text-xs"></i>
                            <p>
                                Backup Database
                            </p>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Transactions -->
            <li class="nav-item has-treeview {{ Route::is('admin.transaction.*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ Route::is('admin.transaction.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-exchange-alt"></i>
                    <p>
                        Transaksi
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.transaction.index') }}" class="nav-link {{ Route::is('admin.transaction.index') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon text-xs"></i>
                            <p>
                                Semua Transaksi
                            </p>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Reports -->
            <li class="nav-item mb-2">
                <a href="{{ route('admin.report.index') }}" class="nav-link {{ Route::is('admin.report.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-chart-line"></i>
                    <p>
                        Laporan
                    </p>
                </a>
            </li>
        @endrole

        <!-- Divider -->
        <li class="nav-header" style="font-size: 0.7rem; opacity: 0.5; margin-top: 1rem;">AKUN</li>

        <!-- Profile -->
        <li class="nav-item">
            <a href="{{ route('admin.profile.edit') }}" class="nav-link {{ Route::is('admin.profile.edit') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-circle"></i>
                <p>Profil Saya</p>
            </a>
        </li>

    </ul>
</nav>

<style>
/* Modern Sidebar Styling */
.nav-sidebar .nav-link {
    border-radius: 0.5rem;
    margin-bottom: 0.25rem;
    transition: all 0.2s ease;
}

.nav-sidebar .nav-link:hover {
    background-color: rgba(0,0,0,0.05);
    transform: translateX(2px);
}

.nav-sidebar .nav-link.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
}

.nav-sidebar .nav-treeview .nav-link {
    padding-left: 2.5rem;
    font-size: 0.9rem;
}

.nav-sidebar .nav-treeview .nav-link.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.badge-sm {
    font-size: 0.7rem;
    padding: 0.2rem 0.5rem;
    border-radius: 1rem;
}

.nav-header {
    color: #6c757d;
    font-weight: 600;
    letter-spacing: 0.5px;
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
}

.nav-icon {
    width: 1.5rem;
}

/* Smooth submenu transition */
.nav-item.has-treeview .nav-treeview {
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>