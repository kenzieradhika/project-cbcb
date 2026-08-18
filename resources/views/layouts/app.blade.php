<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TokoKita') - TokoKita</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🛍️</text></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&family=Fredoka:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --cute-bg: #fff0f5;
            --cute-pink: #ff8fc0;
            --cute-pink-2: #ffb3d1;
            --cute-pink-3: #ffe3f0;
            --cute-berry: #e0498c;
            --cute-ink: #5d3550;
            --cute-mint: #9ee8c2;
            --cute-lavender: #cdb4db;
            --cute-butter: #ffe8a3;
            --cute-peach: #ffd6a5;
            --cute-card: #fffdfe;
            --cute-border: #ffc9de;
            --cute-shadow: 0 8px 24px rgba(224, 73, 140, .14);
        }

        body {
            background: linear-gradient(180deg, #fff0f5 0%, #ffeaf3 55%, #fff5fa 100%);
            background-attachment: fixed;
            font-family: 'Fredoka', 'Baloo 2', system-ui, sans-serif;
            color: var(--cute-ink);
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Baloo 2', 'Fredoka', sans-serif;
        }

        /* ---------- Navbar ---------- */
        .navbar-cute {
            background: linear-gradient(90deg, #ff8fc0, #ff6fb0);
            border-bottom: 4px solid #fff;
            border-radius: 0 0 28px 28px;
            box-shadow: 0 6px 20px rgba(224, 73, 140, .25);
        }
        .navbar-cute .navbar-brand {
            color: #fff;
            font-family: 'Baloo 2', sans-serif;
            font-weight: 800;
            letter-spacing: .5px;
        }
        .navbar-cute .nav-link {
            color: #fff;
            font-weight: 600;
        }
        .navbar-cute .nav-link:hover { color: #ffe3f0; }
        .navbar-cute .navbar-toggler {
            border-color: #fff;
            color: #fff;
        }
        .navbar-cute .dropdown-menu {
            border: 2px solid var(--cute-border);
            border-radius: 18px;
            box-shadow: var(--cute-shadow);
        }
        .navbar-cute .dropdown-item { color: var(--cute-ink); border-radius: 12px; }
        .navbar-cute .dropdown-item:hover { background: var(--cute-pink-3); color: var(--cute-berry); }

        /* ---------- Buttons ---------- */
        .btn {
            border-radius: 50rem;
            border-width: 2px;
            font-weight: 600;
            box-shadow: 0 3px 10px rgba(224, 73, 140, .15);
        }
        .btn-primary {
            background: linear-gradient(135deg, #ff9ec4, #ff6fb0);
            border-color: #e0498c;
            color: #fff;
        }
        .btn-primary:hover, .btn-primary:focus {
            background: linear-gradient(135deg, #ff8fb8, #ff5ca5);
            border-color: #d83d82;
            color: #fff;
        }
        .btn-success {
            background: linear-gradient(135deg, #9ee8c2, #63d9a0);
            border-color: #3fae7c;
            color: #12543a;
        }
        .btn-success:hover, .btn-success:focus {
            background: linear-gradient(135deg, #8fe0b6, #50cf93);
            border-color: #37a072;
            color: #12543a;
        }
        .btn-warning {
            background: linear-gradient(135deg, #ffe9ad, #ffd166);
            border-color: #e9b93c;
            color: #6b4e00;
        }
        .btn-warning:hover, .btn-warning:focus {
            background: linear-gradient(135deg, #ffdf8f, #ffc94d);
            border-color: #dcaa2c;
            color: #6b4e00;
        }
        .btn-danger {
            background: linear-gradient(135deg, #ff9db8, #ff6d94);
            border-color: #e0498c;
            color: #fff;
        }
        .btn-danger:hover, .btn-danger:focus {
            background: linear-gradient(135deg, #ff8cab, #ff5a86);
            border-color: #d83d82;
            color: #fff;
        }
        .btn-outline-primary {
            color: var(--cute-berry);
            border-color: #ff8fc0;
        }
        .btn-outline-primary:hover, .btn-outline-primary:focus {
            background: var(--cute-pink-3);
            border-color: #ff8fc0;
            color: var(--cute-berry);
        }
        .btn-outline-secondary {
            color: var(--cute-ink);
            border-color: #d8b3c6;
        }
        .btn-outline-secondary:hover, .btn-outline-secondary:focus {
            background: #fdeef6;
            border-color: #d8b3c6;
            color: var(--cute-ink);
        }
        .btn-outline-danger {
            color: #d34574;
            border-color: #ff9db8;
        }
        .btn-outline-danger:hover, .btn-outline-danger:focus {
            background: #ffe3f0;
            border-color: #ff9db8;
            color: #d34574;
        }

        /* ---------- Cards ---------- */
        .card {
            border: 3px solid var(--cute-border);
            border-radius: 24px;
            background-color: var(--cute-card);
            box-shadow: var(--cute-shadow);
            overflow: hidden;
        }
        .product-card { transition: transform .18s ease, box-shadow .18s ease; }
        .product-card:hover {
            transform: translateY(-6px) rotate(-1deg);
            box-shadow: 0 14px 30px rgba(224, 73, 140, .25);
        }
        .product-img {
            height: 220px;
            object-fit: cover;
            border-radius: 20px 20px 0 0;
        }
        .card-header { border-bottom: 2px dashed var(--cute-border); font-family: 'Baloo 2', sans-serif; }
        .card-footer { border-top: 2px dashed var(--cute-border); }

        /* ---------- Tables ---------- */
        .table { background-color: #fff; }
        .table-hover tbody tr:hover { background-color: #fff5fa; }
        .table-dark {
            --bs-table-color: #fff;
            --bs-table-bg: #ff8fc0;
            --bs-table-border-color: #ffb3d1;
        }
        .table-light {
            --bs-table-color: var(--cute-ink);
            --bs-table-bg: #ffeef6;
            --bs-table-border-color: #ffc9de;
        }

        /* ---------- Badges ---------- */
        .badge { border-radius: 50rem; font-weight: 600; }
        .text-bg-primary { background-color: #ff8fc0 !important; }
        .text-bg-success { background-color: #8ee3b8 !important; color: #12543a !important; }
        .text-bg-warning { background-color: #ffe8a3 !important; color: #6b4e00 !important; }
        .text-bg-danger { background-color: #ff7fa3 !important; color: #fff !important; }
        .text-bg-info { background-color: #b8e0ff !important; color: #2b4a6b !important; }
        .text-bg-secondary { background-color: #d8c7d2 !important; color: #5d3550 !important; }

        /* ---------- Forms ---------- */
        .form-control, .form-select {
            border: 2px solid var(--cute-border);
            border-radius: 16px;
            background-color: #fff;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--cute-pink);
            box-shadow: 0 0 0 .25rem rgba(255, 143, 192, .25);
        }
        .form-check-input:checked {
            background-color: var(--cute-pink);
            border-color: var(--cute-pink);
        }
        .input-group-text {
            border: 2px solid var(--cute-border);
            background: #fff5fa;
        }

        /* ---------- Misc ---------- */
        .price { color: var(--cute-berry); font-weight: 700; }
        .breadcrumb {
            background: #fff;
            border: 2px solid var(--cute-border);
            border-radius: 50rem;
            padding: .5rem 1.1rem;
        }
        .breadcrumb a { color: var(--cute-berry); text-decoration: none; }
        .breadcrumb-item.active { color: var(--cute-ink); }

        .alert { border-radius: 18px; border: 2px solid; }
        .alert-success { background: #eafaf1; border-color: #b6e8cf; color: #1c5e3f; }
        .alert-danger { background: #ffe9ef; border-color: #ffb6c9; color: #a0315a; }
        .alert-info { background: #eaf4ff; border-color: #b8d9ff; color: #2b4a6b; }

        .page-link {
            color: var(--cute-berry);
            border: 2px solid var(--cute-border);
            margin: 0 2px;
            border-radius: 50rem !important;
        }
        .page-link:hover { color: var(--cute-berry); background: var(--cute-pink-3); }
        .page-item.active .page-link {
            background-color: var(--cute-pink);
            border-color: var(--cute-pink);
            color: #fff;
        }

        a { color: var(--cute-berry); }
        a.text-dark, a.text-decoration-none { color: var(--cute-ink) !important; }
        a.text-dark:hover, a.text-decoration-none:hover { color: var(--cute-berry) !important; }

        .text-muted { color: var(--cute-muted) !important; }

        .footer {
            background: #4a2233;
            color: #ffc9de;
            border-radius: 28px 28px 0 0;
        }

        /* ---------- Hero kartun ---------- */
        .hero-cartoon {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #ffb3d1 0%, #ff8fc0 55%, #ff6fb0 100%);
            border: 4px solid #fff;
            border-radius: 40px;
            box-shadow: 0 12px 30px rgba(224, 73, 140, .3);
            color: #fff;
        }
        .hero-cartoon::before,
        .hero-cartoon::after {
            content: "💖";
            position: absolute;
            font-size: 5rem;
            opacity: .25;
        }
        .hero-cartoon::before { top: -18px; right: 40px; transform: rotate(18deg); }
        .hero-cartoon::after {
            content: "🧸";
            bottom: -22px; left: 30px;
            font-size: 4rem;
            transform: rotate(-12deg);
        }
        .hero-emoji {
            display: inline-block;
            font-size: 3rem;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,.15));
        }
        .hero-cartoon h1 {
            color: #fff;
            text-shadow: 0 3px 0 rgba(224, 73, 140, .4);
        }
        .hero-cartoon .lead { color: #fff0f6; }
        .hero-cartoon .btn-cartoon {
            background: #fff;
            color: var(--cute-berry);
            border: 3px solid #fff;
            box-shadow: 0 5px 0 rgba(0,0,0,.12);
        }
        .hero-cartoon .btn-cartoon:hover {
            background: var(--cute-pink-3);
            transform: translateY(-2px);
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-cute">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-bag-heart-fill me-1"></i>TokoKita
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

    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="footer py-4 mt-4">
        <div class="container d-flex justify-content-between align-items-center">
            <span>&copy; {{ date('Y') }} TokoKita. Dibuat dengan Laravel. 🧁</span>
            <span><i class="bi bi-heart-fill text-danger"></i> Belanja mudah, aman &amp; cepat 🌸</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>