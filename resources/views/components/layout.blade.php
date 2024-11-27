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

  <!-- Favicon -->
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

  <style>
    /* General Body Styling */
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      font-family: 'Poppins', sans-serif;
      color: #333;
      background: url('{{ asset('images/background.jpg') }}') no-repeat center center fixed; /* Background image */
      background-size: cover;
    }

    main {
      flex: 1;
      padding: 2rem;
    }

    /* Header Styling */
    header {
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
      font-weight: 600;
      font-size: 1.8rem;
    }

    .navbar-nav .nav-link {
      font-size: 1.2rem;
      padding: 0.5rem 1rem;
      transition: all 0.3s;
    }

    .navbar-nav .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.2);
      border-radius: 5px;
    }

    .btn-info {
      background-color: #17a2b8;
      color: white;
      transition: all 0.3s ease-in-out;
    }

    .btn-info:hover {
      background-color: #138496;
    }

    /* Footer Styling */
    footer {
      background-color: #343a40;
      color: #ffffff;
    }

    footer a {
      color: #17a2b8;
      text-decoration: none;
    }

    footer a:hover {
      text-decoration: underline;
    }

    footer div {
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <!-- Header Section -->
  <header class="bg-primary text-white">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container-fluid">
        <!-- Title and Profile Button -->
        <div class="d-flex align-items-center">
          <a class="navbar-brand" href="#">Agrimart</a>
          @if(Auth::check())
          <a href="/profile" class="btn btn-info btn-sm d-flex align-items-center ms-3 p-2" style="border-radius: 20px;">
            <i class="bi bi-person-circle me-2 fs-5"></i>
            <span>{{ Auth::user()->name }}</span>
          </a>
          @endif
        </div>
    
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    
        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/products">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/vieworder">Cart</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/about">About</a>
            </li>
            @if(!Auth::check())
            
            <li class="nav-item">
              <a class="nav-link" href="/register">Register</a>
            </li>
            @endif
          

            <li class="nav-item">
              <a class="nav-link" href="/contact">Contact</a>
            </li>
            
            @if(Auth::check())
            <li class="nav-item">
              <a class="nav-link" href="/logout">Logout</a>
            </li>
            @else
            <li class="nav-item">
              <a class="nav-link" href="/login">Login</a>
            </li>
            @endif
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Main Section -->
  <main class="py-5">
    <!-- Dynamic Content -->
    {{ $slot }}
  </main>

  <!-- Footer -->
  <footer class="text-center text-lg-start mt-auto py-3">
    <div class="container-fluid py-2">
      © 2024 Agrimart. All rights reserved
    </div>
  </footer>

  <!-- Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
