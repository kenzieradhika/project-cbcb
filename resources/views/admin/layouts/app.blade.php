<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Admin TokoKita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="d-flex" style="min-height: 100vh;">
        <div class="bg-dark text-white p-3" style="width: 240px;">
            <h5 class="mb-4 pt-2"><i class="bi bi-shop me-1"></i>TokoKita Admin</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-1">
                    <a class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active bg-primary rounded' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link text-white {{ request()->routeIs('admin.products.*') ? 'active bg-primary rounded' : '' }}" href="{{ route('admin.products.index') }}">
                        <i class="bi bi-box-seam me-2"></i>Produk
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link text-white {{ request()->routeIs('admin.orders.*') ? 'active bg-primary rounded' : '' }}" href="{{ route('admin.orders.index') }}">
                        <i class="bi bi-receipt me-2"></i>Pesanan
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <a class="nav-link text-white" href="{{ route('home') }}"><i class="bi bi-shop-window me-2"></i>Lihat Toko</a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="nav-link text-white bg-transparent border-0"><i class="bi bi-box-arrow-right me-2"></i>Keluar</button>
                    </form>
                </li>
            </ul>
        </div>
        <div class="flex-grow-1 bg-light">
            <nav class="navbar navbar-light bg-white shadow-sm px-4">
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