<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Admin TokoKita</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🧁</text></svg>">
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

        /* ---------- Sidebar ---------- */
        .sidebar-cute {
            background: linear-gradient(180deg, #ff8fc0, #e86a9e);
            border-radius: 0 28px 28px 0;
            box-shadow: 6px 0 24px rgba(224, 73, 140, .25);
        }
        .sidebar-cute h5 { color: #fff; font-family: 'Baloo 2', sans-serif; font-weight: 800; }
        .sidebar-cute .nav-link {
            color: #fff;
            border-radius: 16px;
            font-weight: 600;
        }
        .sidebar-cute .nav-link:hover { background: rgba(255, 255, 255, .18); color: #fff; }
        .sidebar-cute .nav-link.active {
            background: #fff;
            color: var(--cute-berry);
        }
        .sidebar-cute .nav-link.bg-primary {
            background: #fff !important;
            color: var(--cute-berry);
        }

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
            background-color: #fffdfe;
            box-shadow: var(--cute-shadow);
            overflow: hidden;
        }
        .card-header {
            border-bottom: 2px dashed var(--cute-border);
            font-family: 'Baloo 2', sans-serif;
        }

        /* ---------- Tables ---------- */
        .table { background-color: #fff; }
        .table-hover tbody tr:hover { background-color: #fff5fa; }
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

        /* ---------- Misc ---------- */
        .navbar-light { border-bottom: 3px solid var(--cute-border); }
        .text-muted { color: var(--cute-muted) !important; }
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
        a.text-decoration-none { color: var(--cute-ink) !important; }
        a.text-decoration-none:hover { color: var(--cute-berry) !important; }
        .alert { border-radius: 18px; border: 2px solid; }
        .alert-success { background: #eafaf1; border-color: #b6e8cf; color: #1c5e3f; }
        .alert-danger { background: #ffe9ef; border-color: #ffb6c9; color: #a0315a; }
        .opacity-50 { opacity: .6 !important; }
    </style>
</head>
<body>
    <div class="d-flex" style="min-height: 100vh;">
        <div class="sidebar-cute text-white p-3" style="width: 240px;">
            <h5 class="mb-4 pt-2"><i class="bi bi-shop me-1"></i>TokoKita Admin</h5>
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
            <nav class="navbar navbar-light bg-white px-4">
                <span class="navbar-text">Halo, <strong>{{ auth()->user()->name }}</strong> 🌸</span>
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