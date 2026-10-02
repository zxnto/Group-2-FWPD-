<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'មាសអប្សរា - The Golden Apsara Royal Bistro')</title>

    <!-- Google Fonts: Kantumruy Pro (Khmer), Cinzel (Classic Royal Serif), Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800;900&family=Kantumruy+Pro:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

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

    <!-- Royal Khmer Classic Gold Styling -->
    <style>
        :root {
            --khmer-gold: #D4AF37;
            --khmer-gold-light: #F5D77F;
            --khmer-gold-dark: #A67C1E;
            --khmer-gold-gradient: linear-gradient(135deg, #F3D079 0%, #D4AF37 50%, #A67C1E 100%);
            --khmer-gold-glow: 0 4px 18px rgba(212, 175, 55, 0.35);
            --khmer-crimson: #680C14;
            --khmer-crimson-dark: #4A080E;
            --khmer-dark: #191614;
            --khmer-dark-surface: #221D1A;
            --khmer-bg: #FAF7F2;
            --khmer-cream-border: rgba(212, 175, 55, 0.28);
        }

        body {
            font-family: 'Kantumruy Pro', 'Plus Jakarta Sans', sans-serif;
            background-color: var(--khmer-bg);
            color: #2D2723;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-image: radial-gradient(rgba(212, 175, 55, 0.05) 1px, transparent 0);
            background-size: 24px 24px;
        }

        .font-classic, h1, h2, h3, h4, .navbar-brand {
            font-family: 'Cinzel', 'Kantumruy Pro', serif;
        }

        /* Royal Gold Buttons */
        .btn-gold {
            background: var(--khmer-gold-gradient);
            color: #1A1307;
            font-weight: 700;
            border: 1px solid #E5C365;
            box-shadow: 0 4px 14px rgba(212, 175, 55, 0.28);
            transition: all 0.25s ease;
        }
        .btn-gold:hover, .btn-gold:focus {
            background: linear-gradient(135deg, #FCE39D 0%, #E5BE4A 50%, #B88A22 100%);
            color: #120D04;
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.45);
            transform: translateY(-1px);
        }

        .btn-outline-gold {
            background: transparent;
            color: #A67C1E;
            border: 1.5px solid var(--khmer-gold);
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .btn-outline-gold:hover {
            background: var(--khmer-gold-gradient);
            color: #1A1307;
            border-color: transparent;
        }

        .text-gold {
            color: #C59A27 !important;
        }


        /* Classic Khmer Header Navbar */
        .khmer-navbar {
            background: #FFFFFF;
            border-bottom: 1px solid var(--khmer-cream-border);
            box-shadow: 0 4px 20px rgba(212, 175, 55, 0.08);
        }

        .brand-emblem {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            background: var(--khmer-gold-gradient);
            color: #2D1A04;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.35);
            border: 1px solid #FFE699;
        }

        /* Food Cards with Khmer Classic Gold Accents */
        .food-card {
            border-radius: 18px;
            border: 1px solid var(--khmer-cream-border);
            background: #FFFFFF;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
        }
        .food-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--khmer-gold-gradient);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 2;
        }
        .food-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 32px rgba(166, 124, 30, 0.14);
            border-color: var(--khmer-gold);
        }
        .food-card:hover::before {
            opacity: 1;
        }

        .card-img-wrapper {
            position: relative;
            height: 195px;
            overflow: hidden;
            background: #25201D;
        }
        .card-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .food-card:hover .card-img-wrapper img {
            transform: scale(1.08);
        }

        .badge-gold {
            background: linear-gradient(135deg, #FFF5D6, #FFE799);
            color: #6C4C07;
            font-weight: 700;
            border: 1px solid #E5C365;
            border-radius: 20px;
            padding: 4px 10px;
        }

        /* Khmer Motif Divider (Kbach style) */
        .khmer-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            color: var(--khmer-gold);
            margin: 15px 0;
            font-size: 0.9rem;
            opacity: 0.85;
        }
        .khmer-divider::before, .khmer-divider::after {
            content: "";
            height: 1px;
            width: 80px;
            background: linear-gradient(to right, transparent, var(--khmer-gold), transparent);
        }

        /* Royal Gold Pagination Customization */
        .pagination-khmer {
            margin-bottom: 0;
        }
        .pagination-khmer .page-link {
            border-radius: 10px !important;
            padding: 7px 15px;
            font-size: 0.88rem;
            color: #3A2F25;
            border: 1px solid rgba(212, 175, 55, 0.35);
            background: #FFFFFF;
            transition: all 0.2s ease;
        }
        .pagination-khmer .page-link:hover {
            background: #FFF9E8 !important;
            color: #A67C1E !important;
            border-color: var(--khmer-gold) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.2);
        }
        .pagination-khmer .page-item.active .page-link {
            background: var(--khmer-gold-gradient) !important;
            color: #1A1307 !important;
            border-color: #D4AF37 !important;
            font-weight: 800;
            box-shadow: 0 4px 14px rgba(212, 175, 55, 0.4) !important;
            transform: translateY(-1px);
        }
        .pagination-khmer .page-item.disabled .page-link {
            opacity: 0.45;
            background: #FAF7F2;
            border-color: rgba(212, 175, 55, 0.18);
        }

        .cart-badge {
            position: absolute;
            top: -6px;
            right: -8px;
            font-size: 0.72rem;
            padding: 3px 6px;
            border-radius: 50%;
            background: var(--khmer-crimson);
            color: #FFF;
            border: 1.5px solid var(--khmer-gold);
        }

        /* Status Stepper - Royal Golden Progression */
        .stepper-step {
            position: relative;
            text-align: center;
            flex: 1;
        }
        .stepper-step .step-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 8px;
            background: #E8E2D8;
            color: #8C8174;
            border: 2px solid transparent;
            transition: all 0.3s;
        }
        .stepper-step.completed .step-icon {
            background: var(--khmer-gold-gradient);
            color: #1A1307;
            border-color: #E5C365;
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
        }
        .stepper-step.active .step-icon {
            background: var(--khmer-crimson);
            color: #FFD700;
            border-color: var(--khmer-gold);
            box-shadow: 0 0 0 5px rgba(212, 175, 55, 0.35);
            animation: pulse-gold 2s infinite;
        }

        @keyframes pulse-gold {
            0% { box-shadow: 0 0 0 0 rgba(212, 175, 55, 0.6); }
            70% { box-shadow: 0 0 0 12px rgba(212, 175, 55, 0); }
            100% { box-shadow: 0 0 0 0 rgba(212, 175, 55, 0); }
        }

        /* Modal Close Button (Floating Circular with Gold Accent) */
        .btn-modal-close {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #FFFFFF;
            color: #4A3E36;
            border: 1.5px solid rgba(212, 175, 55, 0.4);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.165, 0.84, 0.44, 1);
            padding: 0;
            outline: none;
        }
        .btn-modal-close:hover {
            background: #FFF9ED;
            color: var(--khmer-crimson);
            border-color: var(--khmer-gold);
            transform: scale(1.08) rotate(90deg);
            box-shadow: 0 6px 16px rgba(212, 175, 55, 0.35);
        }
        .btn-modal-close:active {
            transform: scale(0.95);
        }

        footer {
            margin-top: auto;
            background: #191614;
            color: #C0B4A9;
            border-top: 3px solid var(--khmer-gold);
        }

        /* Royal Dark Mode Variables & Component Styling */
        [data-bs-theme="dark"] {
            --khmer-bg: #130F0C;
            --khmer-dark-surface: #1B1511;
            --khmer-cream-border: rgba(212, 175, 55, 0.22);
            --bs-body-bg: #130F0C;
            --bs-body-color: #E8DDD2;
            --bs-tertiary-bg: #221A15;
            --bs-border-color: rgba(212, 175, 55, 0.22);
        }

        [data-bs-theme="dark"] body {
            background-color: #130F0C;
            color: #E8DDD2;
            background-image: radial-gradient(rgba(212, 175, 55, 0.08) 1px, transparent 0);
        }

        [data-bs-theme="dark"] .khmer-navbar {
            background-color: #18130F !important;
            border-bottom: 1px solid rgba(212, 175, 55, 0.22);
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.5);
        }

        [data-bs-theme="dark"] .bg-white {
            background-color: #1B1511 !important;
            color: #E8DDD2 !important;
        }

        [data-bs-theme="dark"] .bg-light {
            background-color: #241D17 !important;
            color: #E8DDD2 !important;
        }

        [data-bs-theme="dark"] .text-dark {
            color: #F5EBE0 !important;
        }

        [data-bs-theme="dark"] .text-muted {
            color: #A99E93 !important;
        }

        [data-bs-theme="dark"] .text-secondary {
            color: #C0B4A7 !important;
        }

        [data-bs-theme="dark"] .food-card {
            background-color: #1B1511;
            border-color: rgba(212, 175, 55, 0.2);
            color: #E8DDD2;
        }

        [data-bs-theme="dark"] .food-card:hover {
            border-color: var(--khmer-gold);
            box-shadow: 0 16px 35px rgba(0, 0, 0, 0.65);
        }

        [data-bs-theme="dark"] .modal-content {
            background-color: #1A1410 !important;
            color: #E8DDD2 !important;
            border-color: var(--khmer-gold) !important;
        }

        [data-bs-theme="dark"] .btn-modal-close {
            background-color: #251D18 !important;
            color: #F5EBE0 !important;
            border: 1.5px solid rgba(212, 175, 55, 0.5) !important;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.5) !important;
        }

        [data-bs-theme="dark"] .btn-modal-close:hover {
            background-color: #362920 !important;
            color: #FFD700 !important;
            border-color: var(--khmer-gold) !important;
            box-shadow: 0 0 16px rgba(212, 175, 55, 0.5) !important;
            transform: scale(1.08) rotate(90deg);
        }

        [data-bs-theme="dark"] .dropdown-menu {
            background-color: #1D1612 !important;
            border-color: rgba(212, 175, 55, 0.3) !important;
            color: #E8DDD2;
        }

        [data-bs-theme="dark"] .dropdown-item {
            color: #E8DDD2;
        }

        [data-bs-theme="dark"] .dropdown-item:hover {
            background-color: #281F18;
            color: #FFD77F;
        }

        [data-bs-theme="dark"] .form-control,
        [data-bs-theme="dark"] .input-group-text {
            background-color: #201813 !important;
            border-color: rgba(212, 175, 55, 0.3) !important;
            color: #F0E6D8 !important;
        }

        [data-bs-theme="dark"] .form-control:focus {
            background-color: #261E17 !important;
            border-color: var(--khmer-gold) !important;
            color: #FFF !important;
        }

        [data-bs-theme="dark"] .card {
            background-color: #1B1511;
            color: #E8DDD2;
        }

        [data-bs-theme="dark"] .table {
            --bs-table-bg: transparent;
            --bs-table-color: #E8DDD2;
            color: #E8DDD2;
        }

        [data-bs-theme="dark"] .btn-white {
            background-color: #201813 !important;
            color: #E8DDD2 !important;
            border-color: rgba(212, 175, 55, 0.3) !important;
        }

        [data-bs-theme="dark"] .btn-light {
            background-color: #241C16 !important;
            color: #E8DDD2 !important;
            border-color: rgba(212, 175, 55, 0.25) !important;
        }

        [data-bs-theme="dark"] .pagination-khmer .page-link {
            background-color: #1B1511;
            color: #D4AF37;
            border-color: rgba(212, 175, 55, 0.3);
        }

        [data-bs-theme="dark"] .pagination-khmer .page-item.disabled .page-link {
            background-color: #16110D;
            color: #6D6358;
        }

        [data-bs-theme="dark"] .btn-outline-dark {
            color: #F5EBE0 !important;
            border-color: rgba(212, 175, 55, 0.45) !important;
        }

        [data-bs-theme="dark"] .btn-outline-dark:hover {
            background: var(--khmer-gold-gradient) !important;
            color: #1A1307 !important;
            border-color: transparent !important;
        }

        [data-bs-theme="dark"] .btn-outline-secondary {
            color: #D6CBBE !important;
            border-color: rgba(212, 175, 55, 0.3) !important;
        }

        [data-bs-theme="dark"] .btn-outline-secondary:hover {
            background-color: rgba(212, 175, 55, 0.15) !important;
            color: var(--khmer-gold-light) !important;
            border-color: var(--khmer-gold) !important;
        }

        [data-bs-theme="dark"] .top-head-bar {
            background-color: #0A0806 !important;
            border-bottom: 1px solid rgba(212, 175, 55, 0.18) !important;
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Top Utility Head Bar (Above Main Navbar) -->
    <div class="top-head-bar py-1 px-2 px-md-0 position-relative z-3"
         style="background: #120e0b; border-bottom: 1px solid rgba(212, 175, 55, 0.25); color: #d6cbbe; font-size: 0.82rem;">
        <div class="container d-flex align-items-center justify-content-between">
            <!-- Left: Contact & Opening Info -->
            <div class="d-flex align-items-center gap-2 gap-md-3">
                <span class="d-inline-flex align-items-center gap-1.5 text-warning-emphasis">
                    <i class="bi bi-telephone-fill text-gold" style="font-size: 0.72rem;"></i>
                    <a href="tel:+85523999888" class="text-decoration-none text-light text-opacity-75" style="font-size: 0.8rem;">+855 23 999 888</a>
                </span>
                <span class="d-none d-md-inline text-muted opacity-50">&bull;</span>
                <span class="d-none d-md-inline text-light text-opacity-75" style="font-size: 0.78rem;">
                    <i class="bi bi-clock-fill text-gold me-1" style="font-size: 0.72rem;"></i>
                    {{ __('messages.opening_hours') }}
                </span>
                <span class="d-none d-lg-inline text-muted opacity-50">&bull;</span>
                <span class="d-none d-lg-inline text-gold small" style="font-size: 0.75rem;">
                    <i class="bi bi-gem me-1"></i>
                    {{ __('messages.royal_tagline') }}
                </span>
            </div>

            <!-- Right: Theme Switcher & Language Switcher Button Bar -->
            <div class="d-flex align-items-center gap-2">
                <!-- Dark / Light Mode Switcher Button -->
                <button type="button" id="theme-toggle-btn"
                        class="btn btn-sm rounded-pill px-2.5 py-0.5 d-flex align-items-center gap-1.5 fw-semibold text-light text-opacity-75"
                        style="background: rgba(255,255,255,0.08); border: 1px solid rgba(212,175,55,0.35); font-size: 0.74rem; transition: all 0.2s ease;"
                        onclick="toggleColorTheme()"
                        title="{{ __('messages.toggle_theme') }}">
                    <i id="theme-toggle-icon" class="bi bi-moon-stars-fill text-gold" style="font-size: 0.75rem;"></i>
                    <span id="theme-toggle-text">{{ __('messages.dark_mode') }}</span>
                </button>

                <div class="vr bg-secondary opacity-50 d-none d-sm-inline" style="height: 14px;"></div>

                <span class="text-white-50 small d-none d-md-inline" style="font-size: 0.75rem;">
                    <i class="bi bi-translate text-gold me-1"></i>{{ __('messages.select_language') }}:
                </span>
                <div class="lang-switch-group btn-group btn-group-sm p-0.5 rounded-pill"
                     style="background: rgba(255,255,255,0.08); border: 1px solid rgba(212,175,55,0.35);">
                    <a href="{{ route('lang.switch', 'km') }}"
                       class="btn btn-sm rounded-pill px-2.5 py-0.5 fw-semibold d-flex align-items-center gap-1 {{ app()->getLocale() === 'km' ? 'btn-gold shadow-sm' : 'text-light text-opacity-75' }}"
                       style="font-size: 0.74rem; border: none;"
                       title="ប្ដូរទៅភាសាខ្មែរ (Khmer)">
                        <span>🇰🇭</span>
                        <span>{{ __('messages.khmer_lang') }}</span>
                    </a>
                    <a href="{{ route('lang.switch', 'en') }}"
                       class="btn btn-sm rounded-pill px-2.5 py-0.5 fw-semibold d-flex align-items-center gap-1 {{ app()->getLocale() === 'en' ? 'btn-gold shadow-sm' : 'text-light text-opacity-75' }}"
                       style="font-size: 0.74rem; border: none;"
                       title="Switch to English">
                        <span>🇬🇧</span>
                        <span>{{ __('messages.english_lang') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Khmer Classic Navigation Bar -->
    <nav class="navbar navbar-expand-lg khmer-navbar sticky-top py-2">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <span class="brand-emblem"><i class="bi bi-flower1 fs-4"></i></span>
                <div>
                    <div class="fw-bold fs-5 text-dark font-classic mb-0" style="letter-spacing: 0.5px;">
                        GOLDEN <span class="text-gold">APSARA</span>
                    </div>
                    <small class="text-muted d-block" style="font-size: 0.68rem; font-family: 'Kantumruy Pro', sans-serif;">
                        {{ __('messages.bistro_sub') }}
                    </small>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">

                    @auth
                        @if(Auth::user()->isCustomer())
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('orders.*') ? 'active fw-bold text-dark' : 'text-secondary' }}" href="{{ route('orders.index') }}">
                                    <i class="bi bi-bag-check me-1 text-gold"></i> {{ __('messages.my_orders') }}
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->isOwner())
                            <li class="nav-item">
                                <a class="nav-link fw-bold text-gold" href="{{ route('owner.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-1"></i> {{ __('messages.owner_panel') }}
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <!-- Right Actions: Cart & Auth -->
                <div class="d-flex align-items-center gap-3">
                    @php
                        $cartItems = session('cart', []);
                        $cartCount = array_sum(array_column($cartItems, 'quantity'));
                    @endphp

                    <!-- Cart Button with Counter -->
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-gold position-relative rounded-pill px-3 py-1">
                        <i class="bi bi-bag-heart-fill fs-6 text-gold"></i>
                        <span class="ms-1 d-none d-sm-inline">{{ __('messages.cart') }}</span>
                        <span id="cart-counter-badge" class="badge cart-badge {{ $cartCount > 0 ? '' : 'd-none' }}">
                            {{ $cartCount }}
                        </span>
                    </a>

                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-dark rounded-pill px-3 py-1" style="font-size:0.88rem;">{{ __('messages.login') }}</a>
                        <a href="{{ route('register') }}" class="btn btn-gold rounded-pill px-3 py-1" style="font-size:0.88rem;">{{ __('messages.sign_up') }}</a>
                    @else
                        <div class="dropdown">
                            <button class="btn btn-light rounded-pill dropdown-toggle d-flex align-items-center gap-2 py-1 px-3 border" style="border-color: var(--khmer-cream-border) !important;" type="button" data-bs-toggle="dropdown">
                                <img src="{{ Auth::user()->avatar ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop' }}"
                                     class="rounded-circle border border-warning" width="28" height="28" alt="User">
                                <span class="fw-semibold text-truncate text-dark" style="max-width: 120px;">{{ Auth::user()->name }}</span>
                                <span class="badge {{ Auth::user()->isOwner() ? 'bg-danger' : 'bg-warning text-dark' }} text-capitalize" style="font-size: 0.68rem;">
                                    {{ Auth::user()->role }}
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 mt-2 p-2" style="border: 1px solid var(--khmer-cream-border) !important;">
                                <li class="px-3 py-2 border-bottom">
                                    <div class="fw-bold text-dark">{{ Auth::user()->name }}</div>
                                    <small class="text-muted">{{ Auth::user()->email }}</small>
                                </li>
                                @if(Auth::user()->isOwner())
                                    <li><a class="dropdown-item py-2 fw-semibold text-danger" href="{{ route('owner.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> {{ __('messages.owner_panel') }}</a></li>
                                    <li><a class="dropdown-item py-2" href="{{ route('owner.orders.index') }}"><i class="bi bi-receipt me-2 text-gold"></i> Manage Orders</a></li>
                                    <li><a class="dropdown-item py-2" href="{{ route('owner.foods.index') }}"><i class="bi bi-egg-fried me-2 text-gold"></i> Manage Food Menu</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                @else
                                    <li><a class="dropdown-item py-2" href="{{ route('orders.index') }}"><i class="bi bi-bag-check me-2 text-gold"></i> {{ __('messages.my_orders') }}</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                @endif
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger d-flex align-items-center gap-2">
                                            <i class="bi bi-box-arrow-right"></i> {{ __('messages.logout') }}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Global Toast / Alert Notifications -->
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0 d-flex align-items-center gap-2" role="alert" style="border-left: 4px solid var(--khmer-gold) !important;">
                <i class="bi bi-check-circle-fill fs-5 text-success"></i>
                <div class="fw-medium">{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm border-0 d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-exclamation-octagon-fill fs-5 text-danger"></i>
                <div class="fw-medium">{{ session('error') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show rounded-4 shadow-sm border-0 d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-info-circle-fill fs-5 text-info"></i>
                <div class="fw-medium">{{ session('info') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show rounded-4 shadow-sm border-0 d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-exclamation-triangle-fill fs-5 text-warning"></i>
                <div class="fw-medium">{{ session('warning') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <!-- Main Dynamic Content -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Classic Khmer Footer -->
    <footer class="py-5 mt-5">
        <div class="container text-center">
            <div class="d-flex justify-content-center align-items-center gap-2 mb-2">
                <span class="brand-emblem" style="width:34px; height:34px;"><i class="bi bi-flower1 fs-5"></i></span>
                <span class="fw-bold text-white font-classic fs-5">GOLDEN APSARA <span class="text-gold">ROYAL BISTRO</span></span>
            </div>
            <div class="khmer-divider">
                <span>❖</span>
                <span>មាសអប្សរា</span>
                <span>❖</span>
            </div>
            <p class="small text-white-50 mb-1">
                ប្រព័ន្ធគ្រប់គ្រងការបញ្ជាទិញ និងដឹកជញ្ជូនម្ហូប &bull; Food Ordering & Delivery Management System
            </p>
            <p class="small mb-0" style="color: var(--khmer-gold-light); font-size: 0.78rem;">
                Crafted with Classic Khmer Royal Heritage &bull; Laravel 12 &bull; Bootstrap 5 &bull; ABA KHQR Integration
            </p>
        </div>
    </footer>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Global Cart Helper Script -->
    <script>
        function updateCartBadge(count) {
            const badge = document.getElementById('cart-counter-badge');
            if (badge) {
                badge.innerText = count;
                if (count > 0) {
                    badge.classList.remove('d-none');
                } else {
                    badge.classList.add('d-none');
                }
            }
        }

        // Dark / Light Color Theme Management
        function applyColorTheme(theme, save = true) {
            document.documentElement.setAttribute('data-bs-theme', theme);
            if (save) {
                localStorage.setItem('golden_apsara_theme', theme);
            }

            const toggleBtn = document.getElementById('theme-toggle-btn');
            const icon = document.getElementById('theme-toggle-icon');
            const text = document.getElementById('theme-toggle-text');
            const ownerIcon = document.getElementById('owner-theme-toggle-icon');
            const ownerText = document.getElementById('owner-theme-toggle-text');

            const isDark = theme === 'dark';
            const darkLabel = '{{ __('messages.dark_mode') }}';
            const lightLabel = '{{ __('messages.light_mode') }}';

            if (icon) {
                icon.className = isDark ? 'bi bi-sun-fill text-warning' : 'bi bi-moon-stars-fill text-gold';
            }
            if (text) {
                text.innerText = isDark ? lightLabel : darkLabel;
            }
            if (toggleBtn) {
                if (isDark) {
                    toggleBtn.style.background = 'rgba(212, 175, 55, 0.2)';
                    toggleBtn.style.borderColor = 'var(--khmer-gold)';
                } else {
                    toggleBtn.style.background = 'rgba(255, 255, 255, 0.08)';
                    toggleBtn.style.borderColor = 'rgba(212, 175, 55, 0.35)';
                }
            }

            if (ownerIcon) {
                ownerIcon.className = isDark ? 'bi bi-sun-fill text-warning' : 'bi bi-moon-stars-fill text-gold';
            }
            if (ownerText) {
                ownerText.innerText = isDark ? lightLabel : darkLabel;
            }
        }

        function toggleColorTheme() {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme') || 'light';
            const nextTheme = currentTheme === 'dark' ? 'light' : 'dark';
            applyColorTheme(nextTheme, true);
        }

        // Apply saved theme state on load
        document.addEventListener('DOMContentLoaded', function() {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme') || 'light';
            applyColorTheme(currentTheme, false);
        });
    </script>
    @stack('scripts')
</body>
</html>
