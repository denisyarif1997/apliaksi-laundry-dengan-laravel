<!--
/*!
 * Modern Admin Layout 2025
 */
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">
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
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap');

        :root {
            /* Modern Color Palette */
            --primary: #4f46e5;
            --primary-light: #818cf8;
            --primary-dark: #4338ca;
            --secondary: #06b6d4;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
            
            /* Backgrounds */
            --bg-body: #f3f4f6;
            --bg-sidebar: #ffffff;
            --bg-card: #ffffff;
            
            /* Text */
            --text-main: #111827;
            --text-muted: #6b7280;
            --text-light: #9ca3af;
            
            /* Borders & Shadows */
            --border-color: #e5e7eb;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(255, 255, 255, 0.5);
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            -webkit-font-smoothing: antialiased;
        }

        /* Glassmorphism Utilities */
        .glass {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
        }

        /* Sidebar Modernization */
        .main-sidebar {
            background: var(--bg-sidebar);
            box-shadow: var(--shadow-md);
            border-right: none;
        }

        .brand-link {
            border-bottom: 1px solid var(--border-color) !important;
        }

        .user-panel {
            border-bottom: 1px solid var(--border-color) !important;
        }

        .nav-sidebar .nav-item .nav-link {
            border-radius: 8px;
            margin-bottom: 4px;
            color: var(--text-muted);
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .nav-sidebar .nav-item .nav-link:hover {
            background-color: #f3f4f6;
            color: var(--primary);
            transform: translateX(4px);
        }

        .nav-sidebar .nav-item .nav-link.active {
            background-color: var(--primary);
            color: white;
            box-shadow: var(--shadow-md);
        }

        /* Navbar Modernization */
        .main-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
        }

        .navbar-light .navbar-nav .nav-link {
            color: var(--text-muted);
        }

        /* Content Wrapper */
        .content-wrapper {
            background: transparent;
        }

        .content-header h1 {
            font-weight: 700;
            color: var(--text-main);
            letter-spacing: -0.5px;
        }

        /* Cards */
        .card {
            background: var(--bg-card);
            border: none;
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
            padding: 1.25rem 1.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Buttons */
        .btn {
            border-radius: 8px;
            font-weight: 500;
            padding: 0.5rem 1.25rem;
            transition: all 0.2s;
            box-shadow: var(--shadow-sm);
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-1px);
        }

        /* Form Inputs */
        .form-control {
            border-radius: 8px;
            border: 1px solid var(--border-color);
            padding: 0.6rem 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        /* Table Styling */
        .table thead th {
            border-top: none;
            border-bottom: 2px solid var(--border-color);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: var(--text-muted);
        }

        .table td {
            vertical-align: middle;
            color: var(--text-main);
        }

        /* Dark Mode Overrides */
        .dark-mode {
            --bg-body: #111827;
            --bg-sidebar: #1f2937;
            --bg-card: #1f2937;
            --text-main: #f9fafb;
            --text-muted: #9ca3af;
            --border-color: #374151;
        }
        
        .dark-mode .main-header {
            background: rgba(31, 41, 55, 0.8);
        }

        /* ===== Mobile Friendly (Responsive) ===== */
        @media (max-width: 768px) {
            /* Sidebar becomes overlay drawer on mobile */
            .main-sidebar {
                width: 260px !important;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 1050;
                position: fixed;
                height: 100%;
            }
            body.sidebar-open .main-sidebar {
                transform: translateX(0);
            }
            /* Dim background when sidebar open */
            body.sidebar-open::before {
                content: "";
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.45);
                z-index: 1040;
            }
            .content-wrapper,
            .main-footer {
                margin-left: 0 !important;
            }
            /* Reduce content padding */
            .content-header {
                padding-top: 0.75rem;
            }
            .content {
                padding: 0 0.5rem !important;
            }
            .card-body {
                padding: 1rem;
            }
            /* Make cards full width */
            .col-md-6, .col-md-8, .col-md-10, .col-md-12 {
                padding-left: 0;
                padding-right: 0;
            }
            /* Tables scroll horizontally instead of breaking layout */
            .table-responsive {
                border: 0;
            }
            .table {
                white-space: nowrap;
            }
            /* Bigger touch targets for buttons */
            .btn {
                padding: 0.55rem 1rem;
            }
            .main-header .navbar-nav .btn {
                font-size: 0.85rem;
            }
            /* Stack navbar items */
            .navbar-nav.ml-auto {
                margin-left: auto !important;
            }
            /* Content header title smaller */
            .content-header h1 {
                font-size: 1.25rem;
            }
            /* Hide breadcrumb on very small screens to save space */
            .content-header .col-sm-6:last-child {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .card-body {
                padding: 0.75rem;
            }
            .btn {
                font-size: 0.85rem;
            }
        }
    </style>
    
    @stack('styles')
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

        // Mobile sidebar toggle (overlay drawer)
        $(document).ready(function() {
            $('[data-widget="pushmenu"]').on('click', function(e) {
                e.preventDefault();
                $('body').toggleClass('sidebar-open');
            });
            // Close sidebar when clicking the dimmed overlay
            $('body').on('click', function(e) {
                if ($('body').hasClass('sidebar-open') &&
                    !$(e.target).closest('.main-sidebar').length &&
                    !$(e.target).closest('[data-widget="pushmenu"]').length) {
                    $('body').removeClass('sidebar-open');
                }
            });
        });
    </script>
    
    <x-alert />
    @stack('scripts')
    @yield('js')
</body>

</html>