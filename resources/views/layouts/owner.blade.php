<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('messages.owner_panel') . ' - Golden Apsara')</title>

    <!-- Google Fonts: Kantumruy Pro & Cinzel & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Kantumruy+Pro:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Anti-flicker Dark/Light Theme Script -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('golden_apsara_theme') || 'light';
            document.documentElement.setAttribute('data-bs-theme', savedTheme);
        })();
    </script>

    <style>
        :root {
            --khmer-gold: #D4AF37;
            --khmer-gold-light: #F5D77F;
            --khmer-gold-dark: #A67C1E;
            --khmer-gold-gradient: linear-gradient(135deg, #F3D079 0%, #D4AF37 50%, #A67C1E 100%);
            --sidebar-bg: #0B1120;
            --sidebar-hover: rgba(255, 255, 255, 0.07);
            --content-bg: #F8FAFC;
            --card-bg: #FFFFFF;
            --card-border: #E2E8F0;
            --table-header-bg: #F1F5F9;
            --table-header-color: #475569;
            --text-main: #0F172A;
            --text-sub: #64748B;
        }

        [data-bs-theme="dark"] {
            --content-bg: #0B0F19;
            --card-bg: #1E293B;
            --card-border: rgba(255, 255, 255, 0.08);
            --table-header-bg: #141D2E !important;
            --table-header-color: #94A3B8 !important;
            --text-main: #F8FAFC;
            --text-sub: #94A3B8;
            --bs-body-bg: #0B0F19;
            --bs-body-color: #E2E8F0;
        }

        body {
            font-family: 'Kantumruy Pro', 'Plus Jakarta Sans', -apple-system, sans-serif;
            background-color: var(--content-bg);
            color: var(--text-main);
            min-height: 100vh;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        .font-khmer {
            font-family: 'Kantumruy Pro', sans-serif;
        }

        .font-classic {
            font-family: 'Cinzel', 'Kantumruy Pro', serif;
            letter-spacing: -0.2px;
        }

        .font-brand {
            font-family: 'Cinzel', serif;
            letter-spacing: 0.8px;
        }

        /* Table Header & Table Customization */
        .table thead th,
        .table-header-custom,
        .table-light,
        [data-bs-theme="dark"] .table-light {
            background-color: var(--table-header-bg) !important;
            color: var(--table-header-color) !important;
            border-bottom: 1px solid var(--card-border) !important;
            font-weight: 700;
            font-size: 0.76rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        [data-bs-theme="dark"] body {
            background-color: #0B0F19;
            color: #E2E8F0;
        }

        [data-bs-theme="dark"] .owner-topbar {
            background-color: #0F172A !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
        }

        [data-bs-theme="dark"] .card,
        [data-bs-theme="dark"] .card-header,
        [data-bs-theme="dark"] .card-footer,
        [data-bs-theme="dark"] .modal-content {
            background-color: #1E293B !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
            color: #E2E8F0 !important;
        }

        [data-bs-theme="dark"] .table {
            --bs-table-bg: transparent;
            --bs-table-color: #E2E8F0;
            color: #E2E8F0 !important;
        }

        [data-bs-theme="dark"] .table td {
            border-color: rgba(255, 255, 255, 0.06) !important;
            color: #E2E8F0;
        }

        [data-bs-theme="dark"] .bg-white {
            background-color: #1E293B !important;
            color: #E2E8F0 !important;
        }

        [data-bs-theme="dark"] .bg-light {
            background-color: #151D2A !important;
            color: #E2E8F0 !important;
        }

        [data-bs-theme="dark"] .text-dark {
            color: #F8FAFC !important;
        }

        [data-bs-theme="dark"] .text-muted {
            color: #94A3B8 !important;
        }

        [data-bs-theme="dark"] .text-secondary {
            color: #CBD5E1 !important;
        }

        [data-bs-theme="dark"] .form-control,
        [data-bs-theme="dark"] .form-select,
        [data-bs-theme="dark"] .input-group-text {
            background-color: #0F172A !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
            color: #E2E8F0 !important;
        }

        [data-bs-theme="dark"] .form-control:focus,
        [data-bs-theme="dark"] .form-select:focus {
            border-color: var(--khmer-gold) !important;
            box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.2) !important;
        }

        [data-bs-theme="dark"] .border,
        [data-bs-theme="dark"] .border-top,
        [data-bs-theme="dark"] .border-bottom,
        [data-bs-theme="dark"] .border-start,
        [data-bs-theme="dark"] .border-end {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        [data-bs-theme="dark"] .btn-white {
            background-color: #1E293B !important;
            color: #E2E8F0 !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
        }
        [data-bs-theme="dark"] .btn-white:hover {
            background-color: #2D3748 !important;
            color: #FFFFFF !important;
        }

        [data-bs-theme="dark"] .btn-light {
            background-color: #242F42 !important;
            color: #F1F5F9 !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
        }
        [data-bs-theme="dark"] .btn-light:hover {
            background-color: #334155 !important;
            color: #FFFFFF !important;
        }

        [data-bs-theme="dark"] .btn-outline-secondary {
            color: #CBD5E1 !important;
            border-color: rgba(255, 255, 255, 0.2) !important;
        }
        [data-bs-theme="dark"] .btn-outline-secondary:hover {
            background-color: rgba(212, 175, 55, 0.15) !important;
            color: var(--khmer-gold-light) !important;
            border-color: var(--khmer-gold) !important;
        }

        /* Modern Sidebar */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background-color: var(--sidebar-bg);
            color: #94A3B8;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1000;
            transition: all 0.25s ease;
            overflow-y: auto;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-brand {
            padding: 20px 22px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
        }

        .sidebar .nav-link {
            color: #94A3B8;
            font-weight: 500;
            font-size: 0.88rem;
            padding: 10px 18px;
            border-radius: 10px;
            margin: 3px 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.18s ease;
            border-left: 3px solid transparent;
        }

        .sidebar .nav-link:hover {
            color: #F8FAFC;
            background-color: var(--sidebar-hover);
        }

        .sidebar .nav-link.active {
            color: #F5D77F;
            background: rgba(212, 175, 55, 0.12);
            font-weight: 600;
            border-left: 3px solid var(--khmer-gold);
        }

        .sidebar .nav-link.active i {
            color: #F5D77F !important;
        }

        .sidebar .nav-link i {
            font-size: 1.15rem;
            transition: transform 0.2s ease;
        }

        .sidebar .nav-link:hover i {
            transform: scale(1.08);
        }

        .main-wrapper {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.25s ease;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                margin-left: -260px;
            }
            .sidebar.show {
                margin-left: 0;
            }
            .main-wrapper {
                margin-left: 0;
            }
        }

        /* Top Header */
        .owner-topbar {
            background: #FFFFFF;
            height: 64px;
            border-bottom: 1px solid var(--card-border);
            padding: 0 28px;
        }

        /* Buttons & Badges */
        .btn-gold {
            background: var(--khmer-gold-gradient);
            color: #1A1307;
            font-weight: 600;
            border: 1px solid #E5C365;
            box-shadow: 0 2px 6px rgba(212, 175, 55, 0.25);
            transition: all 0.2s ease;
        }
        .btn-gold:hover, .btn-gold:focus {
            background: linear-gradient(135deg, #FCE39D 0%, #E5BE4A 50%, #B88A22 100%);
            color: #120D04;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.35);
        }

        .card {
            border: 1px solid var(--card-border);
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03), 0 6px 16px -4px rgba(0,0,0,0.04);
            background: var(--card-bg);
        }

        .stat-card {
            border-radius: 16px;
            border: 1px solid var(--card-border);
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px -6px rgba(0,0,0,0.08);
            border-color: #CBD5E1 !important;
        }

        .stat-icon-box {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }

        /* Theme-Adaptive Stat Icon Themes */
        .stat-icon-gold {
            background: rgba(212, 175, 55, 0.15);
            color: #B48811;
        }
        [data-bs-theme="dark"] .stat-icon-gold {
            background: rgba(212, 175, 55, 0.22);
            color: #F5D77F;
        }

        .stat-icon-blue {
            background: rgba(59, 130, 246, 0.12);
            color: #2563EB;
        }
        [data-bs-theme="dark"] .stat-icon-blue {
            background: rgba(59, 130, 246, 0.22);
            color: #60A5FA;
        }

        .stat-icon-green {
            background: rgba(16, 185, 129, 0.12);
            color: #059669;
        }
        [data-bs-theme="dark"] .stat-icon-green {
            background: rgba(16, 185, 129, 0.22);
            color: #34D399;
        }

        .stat-icon-orange {
            background: rgba(249, 115, 22, 0.12);
            color: #EA580C;
        }
        [data-bs-theme="dark"] .stat-icon-orange {
            background: rgba(249, 115, 22, 0.22);
            color: #FB923C;
        }

        .stat-icon-red {
            background: rgba(239, 68, 68, 0.12);
            color: #DC2626;
        }
        [data-bs-theme="dark"] .stat-icon-red {
            background: rgba(239, 68, 68, 0.22);
            color: #F87171;
        }

        /* Status Badge Utilities - Enhanced for Light & Dark Modes */
        .badge-status {
            padding: 5px 12px;
            font-size: 0.76rem;
            font-weight: 600;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .badge-status::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: currentColor;
        }
        .badge-pending {
            background: rgba(251, 191, 36, 0.16);
            color: #D97706;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }
        .badge-confirmed {
            background: rgba(59, 130, 246, 0.16);
            color: #2563EB;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }
        .badge-preparing {
            background: rgba(139, 92, 246, 0.16);
            color: #7C3AED;
            border: 1px solid rgba(139, 92, 246, 0.3);
        }
        .badge-delivery {
            background: rgba(6, 182, 212, 0.16);
            color: #0891B2;
            border: 1px solid rgba(6, 182, 212, 0.3);
        }
        .badge-delivered {
            background: rgba(16, 185, 129, 0.16);
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }
        .badge-cancelled {
            background: rgba(239, 68, 68, 0.16);
            color: #DC2626;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        [data-bs-theme="dark"] .badge-pending { color: #FBBF24; }
        [data-bs-theme="dark"] .badge-confirmed { color: #60A5FA; }
        [data-bs-theme="dark"] .badge-preparing { color: #A78BFA; }
        [data-bs-theme="dark"] .badge-delivery { color: #22D3EE; }
        [data-bs-theme="dark"] .badge-delivered { color: #34D399; }
        [data-bs-theme="dark"] .badge-cancelled { color: #F87171; }

        /* Royal Gold Pagination Customization */
        .pagination-khmer {
            margin-bottom: 0;
        }
        .pagination-khmer .page-link {
            border-radius: 10px !important;
            padding: 7px 15px;
            font-size: 0.88rem;
            color: #334155;
            border: 1px solid var(--card-border);
            background: var(--card-bg);
            transition: all 0.2s ease;
        }
        .pagination-khmer .page-link:hover {
            background: #F1F5F9 !important;
            color: #0F172A !important;
            border-color: #CBD5E1 !important;
        }
        [data-bs-theme="dark"] .pagination-khmer .page-link:hover {
            background: #2D3748 !important;
            color: #FFFFFF !important;
        }
        .pagination-khmer .page-item.active .page-link {
            background: var(--khmer-gold-gradient) !important;
            color: #1A1307 !important;
            border-color: #D4AF37 !important;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(212, 175, 55, 0.35) !important;
        }
        .pagination-khmer .page-item.disabled .page-link {
            opacity: 0.5;
            background: var(--content-bg);
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Modern Owner Sidebar -->
    <aside class="sidebar d-flex flex-column" id="ownerSidebar">
        <!-- Brand Header -->
        <div class="sidebar-brand">
            <div class="d-flex align-items-center gap-3">
                <span class="d-inline-flex align-items-center justify-content-center text-dark rounded-3"
                      style="width: 38px; height: 38px; background: var(--khmer-gold-gradient); box-shadow: 0 2px 8px rgba(212,175,55,0.35);">
                    <i class="bi bi-flower1 fs-5 text-dark"></i>
                </span>
                <div>
                    <h6 class="mb-0 fw-bold text-white font-classic" style="letter-spacing: 0.5px; font-size: 0.95rem;">GOLDEN APSARA</h6>
                    <small style="color: #64748B; font-size: 0.72rem;">{{ __('messages.owner_panel') }}</small>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <div class="py-3 px-1">
            <div class="px-3 mb-2 text-uppercase text-secondary" style="font-size: 0.68rem; letter-spacing: 1px; font-weight: 700;">{{ app()->getLocale() === 'km' ? 'ម៉ឺនុយមេ' : 'Main Menu' }}</div>
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}" href="{{ route('owner.dashboard') }}">
                        <i class="bi bi-grid-1x2"></i>
                        <span>{{ __('messages.dashboard') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    @php
                        $pendingOrdersCount = \App\Models\Order::where('status', 'Pending')->count();
                    @endphp
                    <a class="nav-link {{ request()->routeIs('owner.orders.*') ? 'active' : '' }}" href="{{ route('owner.orders.index') }}">
                        <i class="bi bi-receipt"></i>
                        <span>{{ __('messages.manage_orders') }}</span>
                        @if($pendingOrdersCount > 0)
                            <span class="badge ms-auto fw-bold" style="background: #FEF3C7; color: #92400E; font-size: 0.7rem; border-radius: 9999px; padding: 2px 8px;">
                                {{ $pendingOrdersCount }} {{ app()->getLocale() === 'km' ? 'ថ្មី' : 'New' }}
                            </span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('owner.foods.*') ? 'active' : '' }}" href="{{ route('owner.foods.index') }}">
                        <i class="bi bi-egg-fried"></i>
                        <span>{{ __('messages.manage_foods') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('owner.categories.*') ? 'active' : '' }}" href="{{ route('owner.categories.index') }}">
                        <i class="bi bi-tags"></i>
                        <span>{{ __('messages.manage_categories') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('owner.reports.*') ? 'active' : '' }}" href="{{ route('owner.reports.index') }}">
                        <i class="bi bi-graph-up-arrow"></i>
                        <span>{{ __('messages.reports') }}</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- User Profile Card at Bottom -->
        <div class="px-3 mt-auto mb-3">
            <div class="p-3 rounded-3" style="background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.07);">
                <div class="d-flex align-items-center gap-2.5 mb-2.5">
                    <img src="{{ Auth::user()->avatar ?? 'https://images.unsplash.com/photo-1577219491135-ce391730fb2c?w=100&h=100&fit=crop' }}"
                         class="rounded-circle border" width="36" height="36" alt="Owner" style="border-color: rgba(212,175,55,0.4) !important; object-fit: cover;">
                    <div class="overflow-hidden">
                        <div class="text-white fw-semibold small text-truncate" style="font-size: 0.82rem;">{{ Auth::user()->name }}</div>
                        <div style="color: #64748B; font-size: 0.7rem;">{{ app()->getLocale() === 'km' ? 'មេចុងភៅ' : 'Executive Chef' }} &bull; Marco</div>
                    </div>
                </div>
                <div class="d-flex gap-1.5">
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-light w-50 py-1" style="font-size: 0.72rem; border-color: rgba(255,255,255,0.15);">
                        <i class="bi bi-eye me-1"></i> {{ __('messages.store') }}
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="w-50">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100 py-1" style="font-size: 0.72rem;">
                            <i class="bi bi-box-arrow-right me-1"></i> {{ __('messages.logout') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="main-wrapper">
        <!-- Top bar -->
        <header class="owner-topbar d-flex justify-content-between align-items-center sticky-top">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-sm btn-light border d-lg-none" type="button" onclick="document.getElementById('ownerSidebar').classList.toggle('show')">
                    <i class="bi bi-list fs-5"></i>
                </button>
                <div class="d-flex align-items-center gap-2.5">
                    <span class="d-inline-flex align-items-center gap-1.5 px-2.5 py-1 rounded-pill" style="background: #ECFDF5; color: #065F46; font-size: 0.76rem; font-weight: 600; border: 1px solid #A7F3D0;">
                        <span class="spinner-grow spinner-grow-sm text-success" style="width: 0.4rem; height: 0.4rem;" role="status"></span>
                        <span>{{ app()->getLocale() === 'km' ? 'ហាងកំពុងបើក' : 'Store Open' }}</span>
                    </span>
                    <span class="text-muted d-none d-sm-inline" style="font-size: 0.82rem;">|</span>
                    <span class="fw-semibold text-dark font-classic d-none d-sm-inline" style="font-size: 0.9rem;">{{ __('messages.bistro_name') }}</span>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <!-- Theme Mode Switcher Button -->
                <button type="button" id="owner-theme-toggle-btn"
                        class="btn btn-sm rounded-pill px-2.5 py-1 d-inline-flex align-items-center gap-1.5 fw-semibold border"
                        style="font-size: 0.76rem;"
                        onclick="toggleColorTheme()"
                        title="{{ __('messages.toggle_theme') }}">
                    <i id="owner-theme-toggle-icon" class="bi bi-moon-stars-fill text-gold"></i>
                    <span id="owner-theme-toggle-text">{{ __('messages.dark_mode') }}</span>
                </button>

                <!-- Language Switcher in Owner Header -->
                <div class="btn-group btn-group-sm p-0.5 rounded-pill"
                     style="background: rgba(0,0,0,0.05); border: 1px solid rgba(212,175,55,0.35);">
                    <a href="{{ route('lang.switch', 'km') }}"
                       class="btn btn-sm rounded-pill px-2 py-0.5 fw-semibold {{ app()->getLocale() === 'km' ? 'btn-warning text-dark shadow-sm' : 'text-body text-opacity-75' }}"
                       style="font-size: 0.74rem; border: none;">
                        <span>🇰🇭 ខ្មែរ</span>
                    </a>
                    <a href="{{ route('lang.switch', 'en') }}"
                       class="btn btn-sm rounded-pill px-2 py-0.5 fw-semibold {{ app()->getLocale() === 'en' ? 'btn-warning text-dark shadow-sm' : 'text-body text-opacity-75' }}"
                       style="font-size: 0.74rem; border: none;">
                        <span>🇬🇧 EN</span>
                    </a>
                </div>

                <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1.5 d-inline-flex align-items-center gap-1.5" target="_blank" style="font-size: 0.8rem; font-weight: 500;">
                    <i class="bi bi-box-arrow-up-right text-warning"></i>
                    <span>{{ app()->getLocale() === 'km' ? 'មើលហាងផ្ទាល់' : 'Live Store' }}</span>
                </a>
            </div>
        </header>

        <!-- Flash alerts -->
        <div class="container-fluid px-4 mt-3">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0 d-flex align-items-center gap-2.5 py-2.5 px-3" role="alert" style="background: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0 !important;">
                    <i class="bi bi-check-circle-fill text-success fs-5"></i>
                    <div style="font-size: 0.88rem;">{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" style="font-size: 0.75rem; padding: 1rem;"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm border-0 d-flex align-items-center gap-2.5 py-2.5 px-3" role="alert" style="background: #FEF2F2; color: #991B1B; border: 1px solid #FECACA !important;">
                    <i class="bi bi-exclamation-octagon-fill text-danger fs-5"></i>
                    <div style="font-size: 0.88rem;">{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" style="font-size: 0.75rem; padding: 1rem;"></button>
                </div>
            @endif
        </div>

        <div class="container-fluid px-4 py-4 flex-grow-1">
            @yield('content')
        </div>

        <footer class="bg-white border-top py-3 px-4 text-center text-muted small mt-auto" style="border-top-color: var(--card-border) !important; font-size: 0.78rem;">
            <span>{{ __('messages.bistro_name') }} &bull; {{ __('messages.owner_panel') }}</span>
        </footer>
    </div>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function applyColorTheme(theme, save = true) {
            document.documentElement.setAttribute('data-bs-theme', theme);
            if (save) {
                localStorage.setItem('golden_apsara_theme', theme);
            }
            const icon = document.getElementById('owner-theme-toggle-icon');
            const text = document.getElementById('owner-theme-toggle-text');
            const isDark = theme === 'dark';
            if (icon) {
                icon.className = isDark ? 'bi bi-sun-fill text-warning' : 'bi bi-moon-stars-fill text-gold';
            }
            if (text) {
                text.innerText = isDark ? '{{ __('messages.light_mode') }}' : '{{ __('messages.dark_mode') }}';
            }
        }

        function toggleColorTheme() {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme') || 'light';
            const nextTheme = currentTheme === 'dark' ? 'light' : 'dark';
            applyColorTheme(nextTheme, true);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme') || 'light';
            applyColorTheme(currentTheme, false);
        });
    </script>
    @stack('scripts')
</body>
</html>
