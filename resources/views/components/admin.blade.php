<!--
/*!
 * Modern Admin Layout 2025
 */
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.1">
    <title>@yield('title', 'Admin') | {{ config('app.name') }}</title>

    <!-- Google Font: Inter -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    
    {{-- Favicons --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('admin/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('admin/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('admin/favicon/site.webmanifest') }}">
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    
    <!-- Modern 2025 Design -->
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --sidebar-bg: #ffffff;
            --sidebar-item: #f1f5f9;
            --content-bg: #f8fafc;
            --card-bg: #ffffff;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --border: #e2e8f0;
        }

        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background: var(--content-bg);
            letter-spacing: -0.01em;
        }

        /* Modern Sidebar */
        .main-sidebar {
            background: var(--sidebar-bg) !important;
            border-right: 1px solid var(--border);
        }

        .sidebar {
            padding: 1rem 0.75rem;
        }

        .user-panel {
            background: rgba(99, 102, 241, 0.05);
            border: 1px solid rgba(99, 102, 241, 0.1);
            border-radius: 12px;
            padding: 1rem !important;
            margin: 0 0 1.5rem 0 !important;
        }

        .user-panel .image img {
            border: 2px solid rgba(99, 102, 241, 0.1);
        }

        .user-panel .info a {
            color: var(--text-primary) !important;
            font-weight: 600;
            font-size: 0.95rem;
        }

        /* Sidebar Navigation - Modern 2025 */
        .nav-sidebar .nav-item {
            margin-bottom: 0.25rem;
        }

        .nav-sidebar .nav-item .nav-link {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            color: var(--text-secondary);
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            margin: 0;
        }

        .nav-sidebar .nav-item .nav-link:hover {
            background: var(--sidebar-item);
            color: var(--text-primary);
            transform: translateX(2px);
        }

        .nav-sidebar .nav-item .nav-link.active {
            background: var(--primary);
            color: #ffffff;
        }

        .nav-sidebar .nav-item .nav-link i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        /* Modern Header */
        .main-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .navbar-nav .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .navbar-nav .nav-link:hover {
            background: var(--content-bg);
            color: var(--text-primary) !important;
        }

        /* Content Area */
        .content-wrapper {
            background: var(--content-bg);
        }

        .content-header h1 {
            font-weight: 700;
            color: var(--text-primary);
            font-size: 1.75rem;
            letter-spacing: -0.02em;
        }

        /* Breadcrumb */
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item {
            font-size: 0.875rem;
            font-weight: 500;
        }

        .breadcrumb-item a {
            color: var(--text-secondary);
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            color: var(--primary);
        }

        .breadcrumb-item.active {
            color: var(--text-primary);
        }

        /* Modern Cards - 2025 Style */
        .card {
            border: 1px solid var(--border);
            border-radius: 16px;
            background: var(--card-bg);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .card-header {
            background: var(--card-bg);
            border-bottom: 1px solid var(--border);
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            font-size: 1rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Modern Buttons */
        .btn {
            border-radius: 10px;
            padding: 0.625rem 1.25rem;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s;
            border: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .btn-success {
            background: #10b981;
        }

        .btn-success:hover {
            background: #059669;
        }

        .btn-danger {
            background: #ef4444;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-warning {
            background: #f59e0b;
            color: white;
        }

        .btn-warning:hover {
            background: #d97706;
        }

        /* Modern Tables */
        .table {
            font-size: 0.9rem;
        }

        .table thead th {
            background: var(--content-bg);
            border-bottom: 2px solid var(--border);
            color: var(--text-secondary);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding: 1rem;
        }

        .table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
        }

        .table tbody tr:hover {
            background: var(--content-bg);
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            color: var(--text-primary);
        }

        /* Forms */
        .form-control {
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 0.625rem 0.875rem;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        /* Modern Footer */
        .main-footer {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-top: 1px solid var(--border);
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .main-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .main-footer a:hover {
            color: var(--primary-dark);
        }

        /* Badge Modern */
        .badge {
            border-radius: 6px;
            padding: 0.35rem 0.65rem;
            font-weight: 600;
            font-size: 0.75rem;
        }

        /* Dark Mode */
        .dark-mode {
            --primary: #818cf8;
            --primary-dark: #6366f1;
            --sidebar-bg: #0f172a;
            --sidebar-item: #1e293b;
            --content-bg: #0f172a;
            --card-bg: #1e293b;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --border: #334155;
        }

        .dark-mode .main-header {
            background: rgba(30, 41, 59, 0.8);
        }

        .dark-mode .main-footer {
            background: rgba(30, 41, 59, 0.8);
        }

        .dark-mode .table thead th {
            background: var(--sidebar-bg);
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(148, 163, 184, 0.3);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(148, 163, 184, 0.5);
        }

        /* Small Info Box Modern */
        .small-box {
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        .small-box > .small-box-footer {
            border-radius: 0 0 16px 16px;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .content {
            animation: fadeIn 0.3s ease;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .content-header h1 {
                font-size: 1.5rem;
            }

            .card-body {
                padding: 1rem;
            }
        }
    </style>
    
    @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed {{ Auth::user()->mode }}-mode">

    <div class="wrapper">
        <!-- Navbar -->
        <x-navbar />
        
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-{{ Auth::user()->mode }}-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        @if (Auth::user()->avatar != null)
                            <img src="{{ Auth::user()->avatar }}" class="img-circle elevation-2" alt="User Image">
                        @else
                            <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                                alt="User Image">
                        @endif
                    </div>
                    <div class="info">
                        <a href="{{ route('admin.dashboard') }}" class="d-block">{{ config('app.name') }}</a>
                    </div>
                </div>
                
                <!-- Sidebar Menu -->
                <x-sidebar />
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('title')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Main content -->
            <section class="content">
                {{ $slot }}
            </section>
        </div>
        
        <!-- Footer -->
        <footer class="main-footer">
            <strong>
                Copyright © 2025-{{ date('Y') }} 
                <a href="https://denisyarif1997.github.io/Portfolio/" target="_blank">
                    Deni Sarifudin
                </a>
            </strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 2.0
            </div>
        </footer>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/sparklines/sparkline.js') }}"></script>
    <script src="{{ asset('admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('admin/dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/toastr.min.js') }}"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
        // Form Validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // Toastr
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
            "positionClass": "toast-top-right",
            "timeOut": "4000",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
    
    <x-alert />
    @yield('js')
</body>

</html>