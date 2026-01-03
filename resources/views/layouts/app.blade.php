<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'TechStore')</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      padding-top: 80px;
      background: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      position: relative;
      min-height: 100vh;
    }

    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: 
        radial-gradient(circle at 20% 50%, rgba(13, 110, 253, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(102, 16, 242, 0.05) 0%, transparent 50%);
      pointer-events: none;
      z-index: 0;
    }

    .navbar {
      background: linear-gradient(90deg, #0d6efd, #6610f2);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      padding: 1rem 0;
      z-index: 1000;
    }

    .navbar-brand {
      font-weight: 800;
      color: #fff !important;
      letter-spacing: 2px;
      font-size: 1.5rem;
      transition: all 0.3s ease;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .navbar-brand:hover {
      transform: scale(1.05);
      text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.3);
    }

    .navbar-brand i {
      font-size: 1.6rem;
      vertical-align: middle;
      margin-right: 8px;
      animation: swing 2s ease-in-out infinite;
    }

    @keyframes swing {
      0%, 100% { transform: rotate(0deg); }
      25% { transform: rotate(10deg); }
      75% { transform: rotate(-10deg); }
    }

    .nav-link {
      color: rgba(255, 255, 255, 0.85) !important;
      transition: all 0.3s ease;
      font-weight: 500;
      padding: 0.6rem 1rem !important;
      border-radius: 8px;
      position: relative;
      overflow: hidden;
    }

    .nav-link::before {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      width: 0;
      height: 2px;
      background: white;
      transition: all 0.3s ease;
      transform: translateX(-50%);
    }

    .nav-link:hover {
      color: #fff !important;
      background: rgba(255, 255, 255, 0.1);
      transform: translateY(-2px);
    }

    .nav-link:hover::before {
      width: 80%;
    }

    .nav-link i {
      margin-right: 6px;
      font-size: 1.1rem;
      vertical-align: middle;
    }

    .navbar-toggler {
      border: 2px solid rgba(255, 255, 255, 0.5);
      border-radius: 10px;
      padding: 0.5rem 0.75rem;
    }

    .navbar-toggler:focus {
      box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.25);
    }

    .dropdown-menu {
      border-radius: 15px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
      border: none;
      padding: 0.5rem;
      margin-top: 0.5rem;
      animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .dropdown-item {
      border-radius: 10px;
      padding: 0.7rem 1rem;
      transition: all 0.2s ease;
      font-weight: 500;
    }

    .dropdown-item:hover {
      background: linear-gradient(90deg, rgba(13, 110, 253, 0.1), rgba(102, 16, 242, 0.1));
      transform: translateX(5px);
    }

    .dropdown-item i {
      margin-right: 8px;
      width: 20px;
      text-align: center;
    }

    .badge-admin {
      font-size: 0.7rem;
      background: linear-gradient(135deg, #ffc107, #ff9800);
      color: #000;
      margin-left: 8px;
      border-radius: 8px;
      padding: 3px 8px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      box-shadow: 0 2px 8px rgba(255, 193, 7, 0.4);
      animation: glow 2s ease-in-out infinite;
    }

    @keyframes glow {
      0%, 100% { box-shadow: 0 2px 8px rgba(255, 193, 7, 0.4); }
      50% { box-shadow: 0 2px 15px rgba(255, 193, 7, 0.7); }
    }

    .container {
      position: relative;
      z-index: 1;
    }

    .container.py-4 {
      animation: fadeIn 0.6s ease;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    footer {
      background: linear-gradient(135deg, #343a40 0%, #212529 100%);
      color: #fff;
      padding: 2.5rem 0;
      text-align: center;
      margin-top: 60px;
      position: relative;
      box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.1);
    }

    footer::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 2px;
      background: linear-gradient(90deg, #0d6efd, #6610f2, #0d6efd);
      background-size: 200% 100%;
      animation: gradientMove 3s ease infinite;
    }

    @keyframes gradientMove {
      0%, 100% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
    }

    footer p {
      margin: 0;
      font-weight: 500;
      font-size: 1rem;
      letter-spacing: 0.5px;
    }

    .nav-item {
      position: relative;
    }

    /* Responsive improvements */
    @media (max-width: 991px) {
      .navbar-collapse {
        background: rgba(13, 110, 253, 0.95);
        padding: 1rem;
        border-radius: 15px;
        margin-top: 1rem;
        backdrop-filter: blur(10px);
      }

      .nav-link {
        margin: 0.25rem 0;
      }

      .dropdown-menu {
        background: rgba(255, 255, 255, 0.98);
      }
    }

    /* Smooth scrolling */
    html {
      scroll-behavior: smooth;
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 12px;
    }

    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
      background: linear-gradient(180deg, #0d6efd, #6610f2);
      border-radius: 6px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(180deg, #0b5ed7, #520dc2);
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">
      <i class="bi bi-shop"></i> TechStore
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}"><i class="bi bi-box-seam"></i> Produits</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}"><i class="bi bi-grid"></i> Catégories</a></li>
      </ul>

      <ul class="navbar-nav ms-auto">
        @auth
          <li class="nav-item"><a class="nav-link" href="{{ route('favorites.index') }}"><i class="bi bi-heart-fill"></i> Favoris</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}"><i class="bi bi-cart-fill"></i> Panier</a></li>

          <!-- Dashboard visible uniquement pour l'admin -->
          @if(auth()->user()->is_admin)
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
              </a>
            </li>
          @endif

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
              <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
              @if(auth()->user()->is_admin)
                <span class="badge-admin">Admin</span>
              @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="{{ route('orders.index') }}"><i class="bi bi-bag-check-fill"></i> Mes commandes</a></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right"></i> Déconnexion</button>
                </form>
              </li>
            </ul>
          </li>
        @else
          <li class="nav-item"><a class="nav-link" href="{{ route('login.form') }}"><i class="bi bi-box-arrow-in-right"></i> Se Connecter</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register.form') }}"><i class="bi bi-pencil-square"></i> S'inscrire</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<!-- Contenu -->
<div class="container py-4">
  @include('partials._alerts')
  @yield('content')
</div>

<!-- Footer -->
<footer>
  <p>&copy; {{ date('Y') }} TechStore — Votre boutique high-tech en ligne</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>