<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Legislative Tracking System') - Sangguniang Panlalawigan</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    @php
        $isAdminRoute = request()->is('admin*');
    @endphp

    <!-- Navigation Bar (Visually distinguishes Admin vs Public areas) -->
    <nav
        class="navbar navbar-expand-lg {{ $isAdminRoute ? 'navbar-dark bg-dark border-bottom border-warning border-3' : 'navbar-dark bg-primary shadow-sm' }}">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2"
                href="{{ $isAdminRoute ? route('admin.ordinances.index') : route('public.search') }}">
                <i class="bi bi-bank2"></i>
                <span>SP Legislative Records</span>
                @if ($isAdminRoute)
                    <span class="badge bg-warning text-dark ms-1">ADMIN PORTAL</span>
                @else
                    <span class="badge bg-light text-primary ms-1">PUBLIC SEARCH</span>
                @endif
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3">
                    @auth
                        <!-- Admin Navigation Links -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.ordinances.*') ? 'active fw-semibold' : '' }}"
                                href="{{ route('admin.ordinances.index') }}">
                                <i class="bi bi-journal-bookmark-fill me-1"></i> Ordinances (Admin)
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.resolutions.*') ? 'active fw-semibold' : '' }}"
                                href="{{ route('admin.resolutions.index') }}">
                                <i class="bi bi-file-earmark-text-fill me-1"></i> Resolutions (Admin)
                            </a>
                        </li>
                    @endauth

                    <!-- Public Search Link (Always accessible) -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.*') ? 'active fw-semibold' : '' }}"
                            href="{{ route('public.search') }}">
                            <i class="bi bi-search me-1"></i> Public Legislative Search
                        </a>
                    </li>
                </ul>

                <!-- Right Side Auth Controls -->
                <div class="d-flex align-items-center gap-2">
                    @auth
                        <span class="navbar-text text-light me-2 small">
                            <i class="bi bi-person-check-fill me-1"></i> {{ auth()->user()->name }}
                        </span>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    @else
                        @if (!request()->routeIs('login'))
                            <a href="{{ route('login') }}" class="btn btn-light btn-sm fw-semibold">
                                <i class="bi bi-lock-fill me-1"></i> Admin Login
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Page Content -->
    <main class="container py-4 grow">
        <!-- Flash Success Alert -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Validation Error Summary Alert -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i> Please fix the following
                    errors:</div>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-top py-3 mt-auto">
        <div class="container text-center text-muted small">
            Sangguniang Panlalawigan — Provincial Ordinances &amp; Resolutions Information System
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
