<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gnosys Digital — Expert-Built Digital Services & Products</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @stack('styles')

    <style>
        html, body {
            max-width: 100%;
            overflow-x: hidden;
        }
        header.navbar-glass {
            background: rgba(255,255,255,0.95);
            box-shadow: 0 6px 20px rgba(15,23,42,0.06);
            border-bottom: 1px solid rgba(15,23,42,0.04);
        }
        .navbar-nav .nav-link { color: #283046; font-weight:600; }
        .navbar-nav .nav-link:hover { color: #0d6efd; background: rgba(13,110,253,0.06); border-radius:8px; }
        .search-input-wrapper { background: #f7fbff; border-radius: 999px; padding: 4px 8px; border:1px solid rgba(15,23,42,0.06); }
        .search-input { border: none; background: transparent; height:40px; }
        .search-input:focus { outline: none; }

        /* New Premium User Profile Styles */
        .user-trigger {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 999px;
            padding: 5px 16px 5px 6px;
            transition: all 0.3s ease;
            font-family: 'Montserrat', sans-serif;
            color: #1e293b;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        }
        .user-trigger:hover, .user-trigger:focus, .user-trigger[aria-expanded="true"] {
            background: #eef2ff;
            border-color: #0d6efd;
            color: #0d6efd !important;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.08);
        }
        .user-trigger .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #0d6efd;
            color: #ffffff;
            font-weight: 700;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }
        .user-trigger:hover .avatar, .user-trigger[aria-expanded="true"] .avatar {
            background: #0056b3;
        }
        .user-trigger::after {
            margin-left: 8px;
            color: #64748b;
            transition: color 0.3s ease;
        }
        .user-trigger:hover::after, .user-trigger[aria-expanded="true"]::after {
            color: #0d6efd;
        }
        .profile-card {
            min-width: 320px;
            border: 1px solid rgba(15, 23, 42, 0.08) !important;
            border-radius: 16px !important;
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.12) !important;
            padding: 1.25rem !important;
            margin-top: 12px !important;
            border-top: 4px solid #0d6efd !important;
            animation: dropdownFadeIn 0.25s ease-out;
        }
        @keyframes dropdownFadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .profile-card-header {
            display: flex;
            align-items: center;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 1rem;
        }
        .profile-card .avatar-lg {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0d6efd, #0056b3);
            color: #ffffff;
            font-size: 1.35rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
        }
        .profile-card .user-name {
            font-weight: 700;
            color: #1e293b;
            font-size: 1.05rem;
            line-height: 1.2;
        }
        .profile-card .user-email {
            font-size: 0.8rem;
            color: #64748b;
            margin-top: 2px;
        }
        .wallet-card {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            color: #ffffff;
            border-radius: 12px;
            padding: 1.1rem;
            position: relative;
            overflow: hidden;
            margin-bottom: 1rem;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.15);
        }
        .wallet-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -30%;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 50%;
            pointer-events: none;
        }
        .wallet-card .wallet-title {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
            margin-bottom: 0.4rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .wallet-card .wallet-balance {
            font-size: 1.6rem;
            font-weight: 700;
            color: #10b981; /* Premium Emerald/Green */
            margin-bottom: 0.75rem;
            font-family: 'Montserrat', sans-serif;
        }
        .wallet-card .add-balance-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff !important;
            font-weight: 600;
            font-size: 0.75rem;
            padding: 0.45rem 0.9rem;
            border-radius: 6px;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .wallet-card .add-balance-btn:hover {
            background: #ffffff;
            color: #0f172a !important;
            border-color: #ffffff;
            box-shadow: 0 4px 10px rgba(255, 255, 255, 0.15);
        }
        .wallet-card .wallet-icon {
            font-size: 2.5rem;
            color: rgba(255, 255, 255, 0.08);
            position: absolute;
            bottom: 5px;
            right: 15px;
            pointer-events: none;
        }
        .profile-menu-links {
            display: flex;
            flex-direction: column;
            gap: 4px;
            border-top: 1px solid #f1f5f9;
            padding-top: 0.75rem;
        }
        .profile-menu-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.65rem 0.85rem;
            border-radius: 8px;
            color: #475569 !important;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .profile-menu-item:hover {
            background: #f1f5f9;
            color: #0d6efd !important;
        }
        .profile-menu-item i {
            font-size: 1.1rem;
            color: #64748b;
            transition: all 0.2s ease;
            width: 20px;
            text-align: center;
        }
        .profile-menu-item:hover i {
            color: #0d6efd;
        }
        .profile-menu-item.logout-item {
            color: #dc2626 !important;
        }
        .profile-menu-item.logout-item:hover {
            background: #fef2f2;
            color: #b91c1c !important;
        }
        .profile-menu-item.logout-item i {
            color: #f87171;
        }
        .profile-menu-item.logout-item:hover i {
            color: #b91c1c;
        }
        main { padding-top:140px; }
        /* Secondary Nav & Dropdown Styles */
        .secondary-nav {
            border-top: 1px solid rgba(15,23,42,0.04);
            background: #fff;
            padding: 0;
        }
        .secondary-nav .navbar-nav {
            width: 100%;
            justify-content: center;
        }
        .secondary-nav .nav-item {
            position: relative;
        }
        .secondary-nav .nav-link {
            padding: 1rem 1.5rem;
            color: #003b73;
            font-weight: 600;
            white-space: nowrap;
        }
        .secondary-nav .nav-link:hover, .secondary-nav .nav-link:focus {
            color: #0d6efd;
            background: transparent;
        }
        .secondary-nav .dropdown-item {
            padding: 0.8rem 1.5rem;
            font-weight: 500;
            color: #1e293b;
            border-bottom: 1px solid #f1f5f9;
            transition: all 0.2s ease;
            white-space: normal;
        }
        .secondary-nav .dropdown-item:last-child {
            border-bottom: none;
        }
        .secondary-nav .dropdown-item:hover {
            background-color: #f8fafc;
            color: #0056b3;
            padding-left: 1.8rem;
        }
        .dropdown-submenu {
            position: relative;
        }
        @media (min-width: 992px) {
            .secondary-nav .dropdown-menu {
                border: none;
                box-shadow: 0 10px 30px rgba(0,0,0,0.08);
                border-radius: 0 0 8px 8px;
                border-top: 3px solid #0056b3;
                padding: 0;
                margin-top: -1px;
                min-width: 260px;
            }
            .dropdown-submenu > .dropdown-menu {
                top: 0;
                left: 100%;
                margin-top: -3px;
                border-radius: 8px;
            }
        }
        @media (max-width: 991px) {
            .secondary-nav .dropdown-menu {
                border: none;
                background: #f8fafc;
                margin: 0;
                padding: 0;
            }
            .dropdown-submenu > .dropdown-menu {
                background: #e2e8f0;
                padding-left: 1rem;
            }
            .secondary-nav .nav-link {
                padding: 0.8rem 1rem;
            }
            .navbar-brand img {
                max-height: 40px !important;
            }
        }
        .sale-badge {
            background-color: #8b9900;
            color: white;
            font-size: 0.75rem;
            padding: 0.3rem 0.5rem;
            border-radius: 50%;
            margin-left: 8px;
            font-weight: bold;
            position: absolute;
            transform: rotate(-10deg);
            margin-top: -10px;
        }
    </style>
</head>

<body>

    <header class="fixed-top navbar-glass top-header">
        <div class="container d-flex align-items-center justify-content-between py-2">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.webp') }}" alt="Gnosys Digital Logo" style="max-height:52px; width:auto;" class="img-fluid">
            </a>

            <div class="search-wrapper d-none d-lg-block mx-4" style="flex: 1; max-width: 500px;">
                <form action="{{ url('/') }}" method="GET" class="d-flex align-items-center w-100">
                    <div class="search-input-wrapper d-flex align-items-center w-100 px-3">
                        <input type="search" name="s" class="search-input w-100" placeholder="Search..." style="outline: none;">
                        <button class="btn btn-link p-0 ms-2 text-dark" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center gap-2">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-dark">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-sm btn-primary">Register</a>
                @endguest

                <!-- Modern Cart Button -->
                <a href="{{ route('cart') }}" class="custom-cart-btn position-relative text-decoration-none d-inline-block">
                    <div class="cart-icon-wrapper d-flex align-items-center justify-content-center">
                        <i class="fas fa-shopping-cart"></i>
                    </div>

                    <!-- Badge -->
                    <span class="cart-count-badge">
                        {{ auth()->check() ? auth()->user()?->getCartItems?->count() : count(session('cart', [])) }}
                    </span>
                </a>

                @auth
                    <div class="dropdown user-dropdown">
                        <button class="user-trigger dropdown-toggle d-flex align-items-center" id="userMenuBtnTop" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="avatar me-0 me-md-2">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</span>
                            <span class="user-name d-none d-md-inline">{{ auth()->user()->name }}</span>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end profile-card" aria-labelledby="userMenuBtnTop">

                            <!-- User Info Header -->
                            <div class="profile-card-header">
                                <div class="avatar-lg me-3">
                                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                                </div>
                                <div>
                                    <div class="user-name">{{ auth()->user()->name }}</div>
                                    <div class="user-email">{{ auth()->user()->email }}</div>
                                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">
                                        Member since: <strong>{{ auth()->user()->created_at->format('M Y') }}</strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Wallet Card -->
                            <div class="wallet-card">
                                <div class="wallet-title">
                                    <i class="fas fa-wallet"></i> Wallet Balance
                                </div>

                                <div class="wallet-balance WalletAmountCount">
                                    $ {{ number_format(auth()->user()->wallet?->balance ?? 0, 2) }}
                                </div>

                                <!-- Add Balance Button -->
                                <a href="#" class="add-balance-btn" data-bs-toggle="modal" data-bs-target="#WalletCardModal">
                                    <i class="fas fa-plus-circle"></i> Add Balance
                                </a>

                                <!-- Right Icon -->
                                <div class="wallet-icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                            </div>

                            <!-- Navigation Links -->
                            <div class="profile-menu-links">
                                <a href="{{ route('profile') }}" class="profile-menu-item">
                                    <i class="fas fa-user-circle"></i> My Profile
                                </a>

                                <form action="{{ route('logout') }}" method="POST" class="m-0 w-100">
                                    @csrf
                                    <button type="submit" class="profile-menu-item logout-item border-0 bg-transparent w-100 text-start" style="outline: none;">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth

                <!-- Hamburger for mobile -->
                <button class="navbar-toggler d-lg-none border-0 ms-1 text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#secondaryNavCollapse" aria-controls="secondaryNavCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
            </div>
        </div>

        <!-- Secondary navigation: main menu below the top bar -->
        <nav class="secondary-nav navbar navbar-expand-lg py-0" aria-label="Main navigation">
            <div class="container">
                <div class="collapse navbar-collapse" id="secondaryNavCollapse">
                    <!-- Mobile Search -->
                    <div class="d-lg-none w-100 p-3 pb-0">
                        <form action="{{ url('/') }}" method="GET" class="d-flex align-items-center w-100">
                            <div class="search-input-wrapper d-flex align-items-center w-100 bg-light">
                                <input type="search" name="s" class="search-input w-100" placeholder="Search...">
                                <button class="btn btn-link p-0 ms-2" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>

                    <ul class="navbar-nav gap-2 gap-lg-4 pb-3 pb-lg-0 w-100">

                        <!-- Digital Products -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="digitalProductsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Digital Products
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="digitalProductsDropdown">
                                <li><a class="dropdown-item" href="{{ url('/digital-products') }}"><b>All Digital Products</b></a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">AI Tools & Automation Packs</a></li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center position-relative" href="#">
                                        eBooks & Guides
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="#">Hosting Add-ons</a></li>
                                <li><a class="dropdown-item" href="#">Marketing Kits</a></li>
                                <li><a class="dropdown-item" href="#">Templates & Frameworks</a></li>
                                <li><a class="dropdown-item" href="#">WordPress Themes & Plugins</a></li>
                            </ul>
                        </li>

                        <!-- Digital Services -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="digitalServicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Digital Services
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="digitalServicesDropdown">
                                <li><a class="dropdown-item" href="{{ url('/digital-services') }}"><b>All Digital Services</b></a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Custom Development</a></li>
                                <li><a class="dropdown-item" href="#">Digital Marketing</a></li>
                                <li><a class="dropdown-item" href="#">eCommerce Development</a></li>
                                <li><a class="dropdown-item" href="#">eCommerce Operations Support</a></li>
                                <li><a class="dropdown-item" href="#">SEO & Content</a></li>
                                <li><a class="dropdown-item" href="#">Server & Devops</a></li>
                                <li><a class="dropdown-item" href="#">Social Media Management</a></li>
                                <li><a class="dropdown-item" href="#">Web & App Development</a></li>
                            </ul>
                        </li>

                        <!-- Solutions -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="solutionsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Solutions
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="solutionsDropdown">
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                                        ERPNext Implementation <i class="fas fa-chevron-right small text-muted d-none d-lg-block"></i><i class="fas fa-chevron-down small text-muted d-lg-none"></i>
                                    </a>
                                    <ul class="dropdown-menu shadow-sm">
                                        <li><a class="dropdown-item" href="{{ route('erpnext-implementation') }}"><b>View All ERPNext</b></a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#">ERPNext For Healthcare</a></li>
                                        <li><a class="dropdown-item" href="#">EPC Project Control with ERPNext</a></li>
                                        <li><a class="dropdown-item" href="#">ERPNext for E-commerce</a></li>
                                        <li><a class="dropdown-item" href="#">ERPNext for Education Institutions</a></li>
                                        <li><a class="dropdown-item" href="#">ERPNext for Financial Services</a></li>
                                        <li><a class="dropdown-item" href="#">ERPNext for Non-Profits & NGOs</a></li>
                                        <li><a class="dropdown-item" href="#">ERPNext for Professional Services Firms</a></li>
                                        <li><a class="dropdown-item" href="#">ERPNext for Retail SMEs</a></li>
                                        <li><a class="dropdown-item" href="#">ERPNext for Trading & Distribution SMEs</a></li>
                                        <li><a class="dropdown-item" href="#">ERPNext Solutions for Manufacturing SMEs</a></li>
                                    </ul>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('channel-distribution-management-software-development') }}">Channel & Distribution</a></li>
                                <li><a class="dropdown-item" href="{{ route('custom-manufacturing-operations-control-software-development') }}">Custom Manufacturing</a></li>
                                <li><a class="dropdown-item" href="#">Custom Warehouse & Inventory</a></li>
                                <li><a class="dropdown-item" href="{{ route('supplychain-logistic') }}">Supply Chain & Logistics</a></li>
                                <li><a class="dropdown-item" href="{{ route('seo-services') }}">SEO Services</a></li>
                                <li><a class="dropdown-item" href="#">Case Study</a></li>
                                <li><a class="dropdown-item" href="{{ route('blog.index') }}">Blog</a></li>
                            </ul>
                        </li>

                    <!-- About Us -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="aboutUsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            About Us
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="aboutUsDropdown">
                            <li><a class="dropdown-item" href="{{ route('contact') }}">Contact</a></li>
                            <li><a class="dropdown-item" href="{{ route('about.culture') }}">Culture Of Change</a></li>
                            <li><a class="dropdown-item" href="{{ route('engagement-models') }}">Engagement Models</a></li>
                            <li><a class="dropdown-item" href="{{ route('refund-return-policy') }}">Refund policy</a></li>
                            <li><a class="dropdown-item" href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                        </ul>
                    </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Wallet Card Modal -->
        <div class="modal fade" id="WalletCardModal" tabindex="-1" aria-labelledby="WalletCardModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">

                    <!-- Header -->
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold" id="WalletCardModalLabel">
                            <i class="bi bi-wallet2 me-2 text-success"></i>
                            Add Wallet Balance
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Body -->
                    <div class="modal-body pt-2">

                        <form method="POST" id="WalletBalanceForm">

                            @csrf

                            <!-- Current Balance -->
                            <div class="wallet-balance-box mb-4">
                                <small class="text-muted d-block">Current Balance</small>

                                <h3 class="fw-bold text-success mb-0 WalletAmountCount">
                                    $ {{ number_format(auth()->user()->wallet?->balance ?? 0, 2) }}
                                </h3>
                            </div>

                            <!-- Amount -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Enter Amount
                                </label>

                                <div class="input-group">
                                    <span class="input-group-text bg-light">$</span>

                                    <input type="number"
                                        class="form-control"
                                        placeholder="Enter amount"
                                        min="1"
                                        name="amount"
                                        id="amount">
                                </div>

                                <small class="text-danger amount-error"></small>
                            </div>

                            <!-- Footer -->
                            <div class="modal-footer border-0 pt-0">
                                <button type="button"
                                        class="btn btn-light"
                                        data-bs-dismiss="modal">
                                    Cancel
                                </button>

                                <button type="submit"
                                        class="btn btn-success px-4"
                                        id="WalletSubmitBtn">
                                    Continue with PayPal
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- Wallet Card Modal End -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-area">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 mb-4">
                    <img src="{{ asset('images/logo.webp') }}" alt="Gnosys Digital" class="mb-4" style="height: 40px;">
                    <p class="mb-4">{{ $settings['footer_about_text'] ?? 'From high-performing websites and automation setups to ready-to-use digital products — we build everything in-house so you can grow with confidence.' }}</p>
                    <div class="social-links">
                        <a href="{{ $settings['facebook_url'] ?? '#' }}"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ $settings['twitter_url'] ?? '#' }}"><i class="fab fa-twitter"></i></a>
                        <a href="{{ $settings['instagram_url'] ?? '#' }}"><i class="fab fa-instagram"></i></a>
                        <a href="{{ $settings['linkedin_url'] ?? '#' }}"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="#">Explore Custom Development</a></li>
                        <li><a href="#">Explore eCommerce Solutions</a></li>
                        <li><a href="{{ route('about.culture') }}">Culture Of Change</a></li>
                        <li><a href="{{ route('digital-products') }}">Digital Products</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us Today</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Digital Services</h5>
                    <ul class="footer-links">
                        <li><a href="#">ERPNext Implementation</a></li>
                        <li><a href="#">Ai Automation Data Services</a></li>
                        <li><a href="#">SEO & Growth Services</a></li>
                        <li><a href="#">Managed WordPress Services</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Contact</h5>
                    <ul class="footer-links">
                        <li><i class="fas fa-map-marker-alt me-2"></i> {{ $settings['contact_address'] ?? '1664, 225 The East Mall, Toronto, ON' }}</li>
                        <li><i class="fas fa-phone-alt me-2"></i> {{ $settings['contact_phone'] ?? '+1 647 947 9546' }}</li>
                        <li><i class="fas fa-envelope me-2"></i> {{ $settings['contact_email'] ?? 'connect@gnosysdigital.com' }}</li>
                    </ul>
                </div>
            </div>
            <div class="row mt-5 pt-4 border-top border-secondary">
                <div class="col-12 text-center text-md-start d-md-flex justify-content-between align-items-center">
                    <p class="mb-0">&copy; 2018 - 2026 by Dwarkadhish E-Commerce Private Limited. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <!-- jQuery Validation -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>

    <!-- Bootstrap & Plugins JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- GSAP for advanced animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/main.js') }}"></script>
    <!-- Video Player JS -->
    <script src="{{ asset('js/video.js') }}"></script>
    <!-- Learning JS -->
    <script src="{{ asset('js/learn.js') }}"></script>
    @stack('scripts')

    <script>
        $(document).ready(function () {

            var modal = $('#WalletCardModal');

            modal.on('show.bs.modal', function () {
                console.log('Wallet modal is opening');
            });

            modal.on('hidden.bs.modal', function () {
                $(this).find('input').val('');
            });

            $('#WalletBalanceForm').validate({
                rules: {
                    amount: {
                        required: true,
                        number: true,
                        min: 1,
                        max: 50000
                    }
                },
                messages: {
                    amount: {
                        required: "Please enter wallet amount.",
                        number: "Amount must be a valid number.",
                        min: "Minimum add balance amount is $1.",
                        max: "Maximum add balance amount is $50,000."
                    }
                },
                errorElement: 'small',
                errorPlacement: function(error, element) {
                    error.addClass('text-danger');
                    error.insertAfter(element.closest('.input-group'));
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function(form) {

                    let btn = $('#WalletSubmitBtn');

                    btn.prop('disabled', true);
                    btn.html('Processing...');

                    $.ajax({
                        url: "{{ route('wallet.store') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            amount: $('#amount').val()
                        },
                        success: function(response) {
                            btn.prop('disabled', false);
                            btn.html('Continue with PayPal');
                            if (response.status) {
                                $('#WalletBalanceForm')[0].reset();
                                $('#amount').removeClass('is-invalid');
                                $('.amount-error').remove();

                                $('.modal-body').prepend(`
                                    <div class="alert alert-success wallet-success-alert">
                                        ${response.message}
                                    </div>
                                `);

                                if (response.data.amount != 0) {
                                    $('.WalletAmountCount').text(`$ ${response.data.amount}`);
                                }

                                setTimeout(() => {
                                    $('.wallet-success-alert').fadeOut();
                                }, 3000);

                                console.log(response);
                            }
                        },
                        error: function(xhr) {
                            btn.prop('disabled', false);
                            btn.html('Continue with PayPal');
                            if (xhr.status === 422) {

                                let errors = xhr.responseJSON.errors;

                                if (errors.amount) {

                                    $('#amount').addClass('is-invalid');

                                    $('.amount-error').remove();

                                    $('#amount').closest('.input-group').after(`
                                        <small class="text-danger amount-error">
                                            ${errors.amount[0]}
                                        </small>
                                    `);
                                }

                            } else {

                                $('.modal-body').prepend(`
                                    <div class="alert alert-danger wallet-error-alert">
                                        Something went wrong.
                                    </div>
                                `);

                                setTimeout(() => {
                                    $('.wallet-error-alert').fadeOut();
                                }, 3000);
                            }
                        }
                    });

                    return false;
                }
            });

            // Submenu logic for mobile and desktop click behavior
            $('.dropdown-submenu > a').on('click', function(e) {
                var submenu = $(this).next('.dropdown-menu');
                $('.dropdown-submenu .dropdown-menu').not(submenu).removeClass('show');
                submenu.toggleClass('show');
                e.preventDefault();
                e.stopPropagation();
            });

        });
    </script>

    {{-- add to cart ajax --}}
    <script>
        $(document).ready(function () {

            $(document).on('click', '.btn-add-to-cart', function (e) {
                e.preventDefault();

                const button = $(this);
                const productID = button.data('product-id');
                const productType  = $(this).data('product-type');
                console.log('productType -> ',$(this));

                // const productPrice = button.data('product-price');

                const productData = button.closest('.product-card');
                const productTitle = productData.find('.product-title').text();
                const productImg = productData.find('.product-img').attr('src');

                if (productID) {

                    button.prop('disabled', true);

                    $.ajax({
                        url: '{{ route('addtocart') }}',
                        type: 'POST',
                        data: {
                            product_id: productID,
                            product_title: productTitle,
                            product_img: productImg,
                            product_type: productType,
                            // product_price: productPrice,
                            product_qty: 1,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            if (response.status) {
                                // alert(response.message);

                                if (response.cart) {
                                    let cartCount = Object.keys(response.cart).length;
                                    $('.cart-count-badge').html(cartCount);
                                }
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function (xhr) {
                            console.log(xhr.responseText);
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                let errorMessage = '';

                                $.each(errors, function (key, value) {
                                    errorMessage += value[0] + '\n';
                                });

                                alert(errorMessage);

                            } else if (xhr.status === 500) {
                                alert('Internal Server Error');
                            } else {
                                alert('Something went wrong');
                            }
                        },
                        complete: function () {
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
