<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ផ្ទាំងគ្រប់គ្រងភោជនីយដ្ឋាន - Owner Portal')</title>

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
            --sidebar-bg: #0F172A;
            --sidebar-hover: rgba(255, 255, 255, 0.06);
            --content-bg: #F8FAFC;
            --card-border: #E2E8F0;
        }

        [data-bs-theme="dark"] {
            --content-bg: #0F172A;
            --card-border: rgba(255, 255, 255, 0.1);
            --bs-body-bg: #0F172A;
            --bs-body-color: #E2E8F0;
        }

        [data-bs-theme="dark"] body {
            background-color: #0B0F19;
            color: #E2E8F0;
        }

        [data-bs-theme="dark"] .owner-topbar {
            background-color: #0F172A !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        [data-bs-theme="dark"] .card {
            background-color: #1E293B !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            color: #E2E8F0;
        }

        [data-bs-theme="dark"] .table {
            --bs-table-bg: transparent;
            --bs-table-color: #E2E8F0;
            color: #E2E8F0;
        }

        [data-bs-theme="dark"] .bg-white {
            background-color: #1E293B !important;
            color: #E2E8F0 !important;
        }

        [data-bs-theme="dark"] .text-dark {
            color: #F8FAFC !important;
        }

        body {
            font-family: 'Kantumruy Pro', 'Plus Jakarta Sans', sans-serif;
            background-color: var(--content-bg);
            color: #1E293B;
            min-height: 100vh;
        }

        .font-classic, h1, h2, h3, h4 {
            font-family: 'Cinzel', 'Kantumruy Pro', serif;
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
            background: #FFFFFF;
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
        }

        /* Status Badge Utilities */
        .badge-status {
            padding: 4px 10px;
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
            background: #FEF3C7;
            color: #B45309;
        }
        .badge-confirmed {
            background: #DBEAFE;
            color: #1D4ED8;
        }
        .badge-preparing {
            background: #EDE9FE;
            color: #6D28D9;
        }
        .badge-delivery {
            background: #CFFAFE;
            color: #0E7490;
        }
        .badge-delivered {
            background: #D1FAE5;
            color: #047857;
        }
        .badge-cancelled {
            background: #FEE2E2;
            color: #B91C1C;
        }

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
            background: #FFFFFF;
            transition: all 0.2s ease;
        }
        .pagination-khmer .page-link:hover {
            background: #F1F5F9 !important;
            color: #0F172A !important;
            border-color: #CBD5E1 !important;
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
            background: #F8FAFC;
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
                    <small style="color: #64748B; font-size: 0.72rem;">ផ្ទាំងគ្រប់គ្រងភោជនីយដ្ឋាន</small>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <div class="py-3 px-1">
            <div class="px-3 mb-2 text-uppercase text-secondary" style="font-size: 0.68rem; letter-spacing: 1px; font-weight: 700;">ម៉ឺនុយមេ (Main Menu)</div>
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}" href="{{ route('owner.dashboard') }}">
                        <i class="bi bi-grid-1x2"></i>
                        <span>ផ្ទាំងគ្រប់គ្រង</span>
                    </a>
                </li>
                <li class="nav-item">
                    @php
                        $pendingOrdersCount = \App\Models\Order::where('status', 'Pending')->count();
                    @endphp
                    <a class="nav-link {{ request()->routeIs('owner.orders.*') ? 'active' : '' }}" href="{{ route('owner.orders.index') }}">
                        <i class="bi bi-receipt"></i>
                        <span>ការកុម្ម៉ង់</span>
                        @if($pendingOrdersCount > 0)
                            <span class="badge ms-auto fw-bold" style="background: #FEF3C7; color: #92400E; font-size: 0.7rem; border-radius: 9999px; padding: 2px 8px;">
                                {{ $pendingOrdersCount }} ថ្មី
                            </span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('owner.foods.*') ? 'active' : '' }}" href="{{ route('owner.foods.index') }}">
                        <i class="bi bi-egg-fried"></i>
                        <span>មុខម្ហូប</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('owner.categories.*') ? 'active' : '' }}" href="{{ route('owner.categories.index') }}">
                        <i class="bi bi-tags"></i>
                        <span>ប្រភេទមុខម្ហូប</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('owner.reports.*') ? 'active' : '' }}" href="{{ route('owner.reports.index') }}">
                        <i class="bi bi-graph-up-arrow"></i>
                        <span>របាយការណ៍</span>
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
                        <div style="color: #64748B; font-size: 0.7rem;">មេចុងភៅ &bull; Chef Marco</div>
                    </div>
                </div>
                <div class="d-flex gap-1.5">
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-light w-50 py-1" style="font-size: 0.72rem; border-color: rgba(255,255,255,0.15);">
                        <i class="bi bi-eye me-1"></i> មើលហាង
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="w-50">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100 py-1" style="font-size: 0.72rem;">
                            <i class="bi bi-box-arrow-right me-1"></i> ចាកចេញ
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
                        <span>ហាងកំពុងបើក</span>
                    </span>
                    <span class="text-muted d-none d-sm-inline" style="font-size: 0.82rem;">|</span>
                    <span class="fw-semibold text-dark font-classic d-none d-sm-inline" style="font-size: 0.9rem;">ភោជនីយដ្ឋាន មាសអប្សរា</span>
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
                    <span>មើលហាងផ្ទាល់ (Live Store)</span>
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
            <span>ប្រព័ន្ធគ្រប់គ្រងភោជនីយដ្ឋាន &bull; Golden Apsara Bistro</span>
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
