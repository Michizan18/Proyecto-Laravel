<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - E-commerce & Blog</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .active {
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">E-commerce & Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">{{ __('Home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('productos.*') ? 'active' : '' }}" href="{{ route('productos.index') }}">{{ __('Products') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('categorias.*') ? 'active' : '' }}" href="{{ route('categorias.index') }}">{{ __('Categories') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('articulos.*') ? 'active' : '' }}" href="{{ route('articulos.index') }}">{{ __('Blog') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('categorias-blog.*') ? 'active' : '' }}" href="{{ route('categorias-blog.index') }}">{{ __('Blog Categories') }}</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('locale', 'es') }}">ES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('locale', 'en') }}">EN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>E-commerce & Blog</h5>
                    <p>{{ __('Proyecto evaluativo de Laravel') }}</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>&copy; {{ date('Y') }} - Daniel Jesús Castillo Botero</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>