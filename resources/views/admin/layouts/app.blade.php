<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Admin TokoKita</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📟</text></svg>">
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
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Archivo Black', 'Space Grotesk', sans-serif;
            font-weight: 900;
            letter-spacing: -.5px;
            text-transform: uppercase;
        }

        /* ---------- Sidebar ---------- */
        .sidebar-cute {
            background: var(--retro-ink);
            border-right: 4px solid var(--retro-orange);
            box-shadow: 6px 0 0 rgba(43, 33, 24, .3);
        }
        .sidebar-cute h5 { color: var(--retro-mustard); font-family: 'Archivo Black', sans-serif; font-weight: 900; }
        .sidebar-cute .nav-link {
            color: #f6f1e7;
            border-radius: 0;
            font-weight: 600;
            text-transform: uppercase;
            font-size: .85rem;
            letter-spacing: .5px;
            border-bottom: 2px solid transparent;
        }
        .sidebar-cute .nav-link:hover {
            background: rgba(255, 193, 69, .18);
            color: var(--retro-mustard);
        }
        .sidebar-cute .nav-link.active {
            background: var(--retro-mustard);
            color: var(--retro-ink);
        }
        .sidebar-cute .nav-link.bg-primary {
            background: var(--retro-mustard) !important;
            color: var(--retro-ink);
        }

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
        .card-header {
            border-bottom: 3px solid var(--retro-border);
            background: var(--retro-mustard);
            font-family: 'Archivo Black', sans-serif;
            text-transform: uppercase;
        }

        /* ---------- Tables ---------- */
        .table { background-color: var(--retro-card); }
        .table-hover tbody tr:hover { background-color: #fdeecb; }
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

        /* ---------- Misc ---------- */
        .navbar-light { border-bottom: 3px solid var(--retro-orange); }
        .text-muted { color: #8b7d6d !important; }
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
        a.text-decoration-none { color: var(--retro-ink) !important; }
        a.text-decoration-none:hover { color: var(--retro-orange-dark) !important; }
        .alert { border-radius: 0; border: 3px solid var(--retro-border); box-shadow: 4px 4px 0 var(--retro-ink); }
        .alert-success { background: #d9f2e5; border-color: var(--retro-border); color: #0a5c45; }
        .alert-danger { background: #fde3de; border-color: var(--retro-border); color: #8f2f26; }
        .opacity-50 { opacity: .6 !important; }
    </style>
</head>
<body>
    <div class="d-flex" style="min-height: 100vh;">
        <div class="sidebar-cute text-white p-3" style="width: 240px;">
            <h5 class="mb-4 pt-2"><i class="bi bi-cart-fill me-1"></i>TokoKita Admin</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-1">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active bg-primary' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active bg-primary' : '' }}" href="{{ route('admin.products.index') }}">
                        <i class="bi bi-box-seam me-2"></i>Produk
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active bg-primary' : '' }}" href="{{ route('admin.orders.index') }}">
                        <i class="bi bi-receipt me-2"></i>Pesanan
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <a class="nav-link" href="{{ route('home') }}"><i class="bi bi-shop-window me-2"></i>Lihat Toko</a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="nav-link bg-transparent border-0"><i class="bi bi-box-arrow-right me-2"></i>Keluar</button>
                    </form>
                </li>
            </ul>
        </div>
        <div class="flex-grow-1">
            <nav class="navbar navbar-light bg-white px-4" style="border-bottom: 3px solid var(--retro-orange);">
                <span class="navbar-text">Halo, <strong>{{ auth()->user()->name }}</strong></span>
            </nav>
            <div class="p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>