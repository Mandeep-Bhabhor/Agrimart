<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Agrimart</title>

  <!-- Zephyr Theme CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/zephyr/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

  <style>
    /* General Styling */
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #e8f5e9, #aed581); /* Light green gradient */
      color: #2e7d32;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    header {
      position: sticky;
      top: 0;
      z-index: 1000;
      background-color: #388e3c;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Navbar */
    .navbar {
      padding: 1rem 2rem;
    }

    .navbar-brand {
      font-size: 2rem;
      font-weight: 700;
    }

    .navbar-nav .nav-link {
      color: white;
      font-size: 1rem;
      padding: 0.8rem 1rem;
      transition: background-color 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.2);
      border-radius: 6px;
    }

    .user-btn {
      background-color: white;
      color: #388e3c;
      border-radius: 20px;
      padding: 0.5rem 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-weight: 500;
      transition: transform 0.3s ease;
    }

    .user-btn:hover {
      transform: scale(1.1);
    }

    .dropdown-menu {
      border: none;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .dropdown-item:hover {
      background-color: #e8f5e9;
      color: #388e3c;
    }

    /* Main Content */
    main {
      flex: 1;
      padding: 8rem;
      width: 1800px;
      margin: 2rem auto;
      /* //max-width: 1200px; */
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Footer */
    footer {
      background-color: #388e3c;
      color: white;
      padding: 2rem 1rem;
      text-align: center;
      margin-top: auto;
    }

    footer a {
      color: #c8e6c9;
      text-decoration: none;
    }

    footer a:hover {
      text-decoration: underline;
      color: white;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Agrimart</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="/products">Products</a></li>
            <li class="nav-item"><a class="nav-link" href="/vieworder">Cart</a></li>
            <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
          </ul>
          <div class="dropdown ms-3">
            @if(Auth::check())
            <a class="btn-dark user-btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="/profile">Profile</a></li>
              <li><a class="dropdown-item" href="/viewplacedorder">Orders</a></li>
              <li><a class="dropdown-item text-danger" href="/logout">Logout</a></li>
            </ul>
            @else
            <a class="btn btn-light ms-3" href="/login">Login</a>
            <a class="btn btn-outline-light ms-2" href="/register">Register</a>
            @endif
          </div>
        </div>
      </div>
    </nav>
  </header>

  <!-- Main -->
  <main>
    {{ $slot }}
  </main>

  <!-- Footer -->
  <footer>
    <p>&copy; 2024 Agrimart. All rights reserved.</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
