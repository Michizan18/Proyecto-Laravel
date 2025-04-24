<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo') - Laravel E-commerce con Blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS personalizado -->
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        main {
            flex-grow: 1;
        }
    </style>
    @yield('css')
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="{{ route('inicio') }}">E-commerce con Blog</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('productos.index') ? 'active' : '' }}" href="{{ route('productos.index') }}">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('categorias.index') ? 'active' : '' }}" href="{{ route('categorias.index') }}">Categorías</a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">|</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('articulos.index*') ? 'active' : '' }}" href="{{ route('articulos.index') }}">Artículos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('categoriasBlog.index*') ? 'active' : '' }}" href="{{ route('blog.categoriasBlog.index') }}">Categorias de Blog</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="py-4">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @yield('contenido')
        </div>
    </main>

    <footer class="bg-dark text-white py-3 mt-5">
        <div class="container text-center">
            <p class="mb-0">© {{ date('Y') }} Laravel E-commerce con Blog. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('js')
</body>
</html>