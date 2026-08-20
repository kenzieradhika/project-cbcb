<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TokoKita') - TokoKita</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🛒</text></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --retro-cream: #f6f1e7;
            --retro-ink: #2b2118;
            --retro-ink-soft: #5a4a3a;
            --retro-orange: #ff5e3a;
            --retro-orange-dark: #d94a22;
            --retro-teal: #0f8b8d;
            --retro-teal-dark: #0a6b6d;
            --retro-mustard: #ffc145;
            --retro-mustard-dark: #cf9a2e;
            --retro-red: #d64b3f;
            --retro-blue: #3d6ab5;
            --retro-card: #fffdf7;
            --retro-border: #2b2118;
            --retro-shadow: 6px 6px 0 rgba(43, 33, 24, .95);
        }

        body {
            background-color: var(--retro-cream);
            background-image: radial-gradient(rgba(43, 33, 24, .08) 1.5px, transparent 1.5px);
            background-size: 26px 26px;
            background-attachment: fixed;
            font-family: 'Space Grotesk', system-ui, sans-serif;
            color: var(--retro-ink);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Archivo Black', 'Space Grotesk', sans-serif;
            font-weight: 900;
            letter-spacing: -.5px;
            text-transform: uppercase;
        }

        /* ---------- Navbar ---------- */
        .navbar-cute {
            background: var(--retro-ink);
            border-bottom: 4px solid var(--retro-orange);
            box-shadow: 0 6px 0 rgba(43, 33, 24, .35);
        }
        .navbar-cute .navbar-brand {
            color: var(--retro-mustard);
            font-family: 'Archivo Black', sans-serif;
            font-size: 1.4rem;
            letter-spacing: .5px;
        }
        .navbar-cute .nav-link {
            color: #f6f1e7;
            font-weight: 600;
            text-transform: uppercase;
            font-size: .85rem;
            letter-spacing: .5px;
        }
        .navbar-cute .nav-link:hover { color: var(--retro-mustard); }
        .navbar-cute .navbar-toggler { border-color: var(--retro-mustard); color: var(--retro-mustard); }
        .navbar-cute .dropdown-menu {
            border: 3px solid var(--retro-border);
            border-radius: 0;
            background: var(--retro-card);
            box-shadow: var(--retro-shadow);
        }
        .navbar-cute .dropdown-item { color: var(--retro-ink); font-weight: 600; border-radius: 0; }
        .navbar-cute .dropdown-item:hover { background: var(--retro-mustard); color: var(--retro-ink); }

        /* ---------- Buttons ---------- */
        .btn {
            border-radius: 0;
            border: 3px solid var(--retro-border);
            font-family: 'Archivo Black', sans-serif;
            text-transform: uppercase;
            letter-spacing: .5px;
            font-size: .85rem;
            box-shadow: 4px 4px 0 var(--retro-ink);
            transition: transform .12s ease, box-shadow .12s ease;
        }
        .btn:hover { transform: translate(2px, 2px); box-shadow: 2px 2px 0 var(--retro-ink); }
        .btn:active { transform: translate(4px, 4px); box-shadow: 0 0 0 var(--retro-ink); }
        .btn-primary {
            background: var(--retro-orange);
            border-color: var(--retro-border);
            color: #fff;
        }
        .btn-primary:hover, .btn-primary:focus {
            background: var(--retro-orange-dark);
            border-color: var(--retro-border);
            color: #fff;
        }
        .btn-success {
            background: var(--retro-teal);
            border-color: var(--retro-border);
            color: #fff;
        }
        .btn-success:hover, .btn-success:focus {
            background: var(--retro-teal-dark);
            border-color: var(--retro-border);
            color: #fff;
        }
        .btn-warning {
            background: var(--retro-mustard);
            border-color: var(--retro-border);
            color: var(--retro-ink);
        }
        .btn-warning:hover, .btn-warning:focus {
            background: var(--retro-mustard-dark);
            border-color: var(--retro-border);
            color: var(--retro-ink);
        }
        .btn-danger {
            background: var(--retro-red);
            border-color: var(--retro-border);
            color: #fff;
        }
        .btn-danger:hover, .btn-danger:focus {
            background: #b83a30;
            border-color: var(--retro-border);
            color: #fff;
        }
        .btn-outline-primary {
            background: transparent;
            color: var(--retro-orange-dark);
            border-color: var(--retro-border);
        }
        .btn-outline-primary:hover, .btn-outline-primary:focus {
            background: var(--retro-orange);
            border-color: var(--retro-border);
            color: #fff;
        }
        .btn-outline-secondary {
            background: transparent;
            color: var(--retro-ink);
            border-color: var(--retro-border);
        }
        .btn-outline-secondary:hover, .btn-outline-secondary:focus {
            background: var(--retro-ink);
            border-color: var(--retro-border);
            color: #f6f1e7;
        }
        .btn-outline-danger {
            background: transparent;
            color: var(--retro-red);
            border-color: var(--retro-border);
        }
        .btn-outline-danger:hover, .btn-outline-danger:focus {
            background: var(--retro-red);
            border-color: var(--retro-border);
            color: #fff;
        }

        /* ---------- Cards ---------- */
        .card {
            border: 3px solid var(--retro-border);
            border-radius: 0;
            background-color: var(--retro-card);
            box-shadow: var(--retro-shadow);
        }
        .product-card { transition: transform .15s ease, box-shadow .15s ease; }
        .product-card:hover {
            transform: translate(-3px, -3px) rotate(-1deg);
            box-shadow: 9px 9px 0 var(--retro-ink);
        }
        .product-img {
            height: 220px;
            object-fit: cover;
            border-bottom: 3px solid var(--retro-border);
            border-radius: 0;
        }
        .card-header {
            border-bottom: 3px solid var(--retro-border);
            background: var(--retro-mustard);
            font-family: 'Archivo Black', sans-serif;
            text-transform: uppercase;
        }
        .card-footer { border-top: 3px solid var(--retro-border); }

        /* ---------- Tables ---------- */
        .table { background-color: var(--retro-card); }
        .table-hover tbody tr:hover { background-color: #fdeecb; }
        .table-dark {
            --bs-table-color: #f6f1e7;
            --bs-table-bg: var(--retro-ink);
            --bs-table-border-color: var(--retro-orange);
        }
        .table-light {
            --bs-table-color: var(--retro-ink);
            --bs-table-bg: var(--retro-mustard);
            --bs-table-border-color: var(--retro-border);
        }

        /* ---------- Badges ---------- */
        .badge { border-radius: 0; border: 2px solid var(--retro-border); font-weight: 700; text-transform: uppercase; }
        .text-bg-primary { background-color: var(--retro-orange) !important; color: #fff !important; }
        .text-bg-success { background-color: var(--retro-teal) !important; color: #fff !important; }
        .text-bg-warning { background-color: var(--retro-mustard) !important; color: var(--retro-ink) !important; }
        .text-bg-danger { background-color: var(--retro-red) !important; color: #fff !important; }
        .text-bg-info { background-color: var(--retro-blue) !important; color: #fff !important; }
        .text-bg-secondary { background-color: #8d7b6a !important; color: #fff !important; }

        /* ---------- Forms ---------- */
        .form-control, .form-select {
            border: 3px solid var(--retro-border);
            border-radius: 0;
            background-color: var(--retro-card);
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--retro-orange);
            box-shadow: 4px 4px 0 var(--retro-ink);
        }
        .form-check-input:checked {
            background-color: var(--retro-teal);
            border-color: var(--retro-border);
        }
        .input-group-text {
            border: 3px solid var(--retro-border);
            border-radius: 0;
            background: var(--retro-mustard);
        }

        /* ---------- Misc ---------- */
        .price { color: var(--retro-orange-dark); font-family: 'Archivo Black', sans-serif; font-weight: 900; }
        .breadcrumb {
            background: var(--retro-card);
            border: 3px solid var(--retro-border);
            border-radius: 0;
            padding: .6rem 1.1rem;
            box-shadow: 4px 4px 0 var(--retro-ink);
        }
        .breadcrumb a { color: var(--retro-orange-dark); text-decoration: none; font-weight: 600; }
        .breadcrumb-item.active { color: var(--retro-ink-soft); }

        .alert { border-radius: 0; border: 3px solid var(--retro-border); box-shadow: 4px 4px 0 var(--retro-ink); }
        .alert-success { background: #d9f2e5; border-color: var(--retro-border); color: #0a5c45; }
        .alert-danger { background: #fde3de; border-color: var(--retro-border); color: #8f2f26; }
        .alert-info { background: #dce8fa; border-color: var(--retro-border); color: #22487e; }

        .page-link {
            color: var(--retro-orange-dark);
            border: 3px solid var(--retro-border);
            margin: 0 3px;
            border-radius: 0 !important;
            font-family: 'Archivo Black', sans-serif;
            background: var(--retro-card);
        }
        .page-link:hover {
            color: var(--retro-ink);
            background: var(--retro-mustard);
            border-color: var(--retro-border);
        }
        .page-item.active .page-link {
            background-color: var(--retro-orange);
            border-color: var(--retro-border);
            color: #fff;
        }

        a { color: var(--retro-orange-dark); }
        a.text-dark, a.text-decoration-none { color: var(--retro-ink) !important; }
        a.text-dark:hover, a.text-decoration-none:hover { color: var(--retro-orange-dark) !important; }

        .text-muted { color: #8b7d6d !important; }

        .footer {
            background: var(--retro-ink);
            color: #cbb9a4;
            border-top: 4px solid var(--retro-orange);
        }
        .footer a { color: var(--retro-mustard); }

        /* ---------- Hero retro ---------- */
        .hero-cartoon {
            position: relative;
            overflow: hidden;
            background: var(--retro-orange);
            border: 4px solid var(--retro-border);
            border-radius: 0;
            box-shadow: 8px 8px 0 var(--retro-ink);
            color: #fff;
        }
        .hero-cartoon::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(rgba(255, 255, 255, .22) 2px, transparent 2px);
            background-size: 22px 22px;
            pointer-events: none;
        }
        .hero-cartoon h1 {
            color: #fff;
            text-transform: uppercase;
        }
        .hero-cartoon .lead { color: #ffe9c7; font-weight: 500; }
        .hero-cartoon .btn-cartoon {
            background: var(--retro-mustard);
            color: var(--retro-ink);
            border: 3px solid var(--retro-border);
            box-shadow: 5px 5px 0 rgba(0, 0, 0, .45);
        }
        .hero-cartoon .btn-cartoon:hover {
            background: #ffd56b;
            transform: translate(2px, 2px);
            box-shadow: 3px 3px 0 rgba(0, 0, 0, .45);
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-cute">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-cart-fill me-1"></i>TokoKita
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">Pesanan Saya</a></li>
                        @if(auth()->user()->is_admin)
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-1"></i>Admin</a></li>
                        @endif
                    @endauth
                </ul>
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                                <i class="bi bi-cart3 fs-5"></i>
                                @php $cartCount = array_sum(session('cart', [])); @endphp
                                @if($cartCount > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $cartCount }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('orders.index') }}">Pesanan Saya</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Keluar</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Masuk</a></li>
                        <li class="nav-item"><a class="btn btn-sm btn-warning ms-2" href="{{ route('register') }}">Daftar</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-0 mb-0" role="alert">
            <div class="container">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-0 mb-0" role="alert">
            <div class="container">{{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <main class="py-4 flex-grow-1">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="footer py-4 mt-4">
        <div class="container d-flex justify-content-between align-items-center">
            <span>&copy; {{ date('Y') }} TokoKita. Dibuat dengan Laravel.</span>
            <span><i class="bi bi-heart-fill text-danger"></i> Belanja mudah, aman &amp; cepat</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>