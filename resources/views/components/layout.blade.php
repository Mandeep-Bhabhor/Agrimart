<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Agrimart</title>

  <!-- Zephyr Theme CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/zephyr/bootstrap.min.css">

  <!-- Favicon -->
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

  <style>
    /* Custom styles to make the form centered */
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    main {
      flex: 1;
    }

    /* Footer fixed at the bottom */
    footer {
      background-color: rgba(0, 0, 0, 0.05);
    }
  </style>
</head>
<body>
  <!-- Header Section -->
  <header class="bg-primary text-white py-3">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container-fluid">
        <a class="navbar-brand fs-3" href="#">Agrimart</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link fs-4" href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fs-4" href="/products">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fs-4" href="/vieworder">Orders</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fs-4" href="/about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fs-4" href="/register">Register</a>
            </li>
            @if(Auth::check())
            <li class="nav-item">
              <a class="nav-link fs-4" href="/logout">Logout</a>
            </li>
            @else
            <li class="nav-item">
              <a class="nav-link fs-4" href="/login">Login</a>
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link fs-4" href="/contact">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Main Section -->
  <main class="d-flex justify-content-center align-items-center py-5">
    <div class="container">
      <!-- Dynamic Content -->
      {{ $slot }}
    </div>
  </main>

  <!-- Footer -->
  <footer class="text-center text-lg-start mt-auto border-top py-3">
    <div class="text-center">
      © 2024 Agrimart. All rights reserved. Powered by 
      <a class="text-body" href="https://mdbootstrap.com/">MDBootstrap</a>
    </div>
  </footer>

  <!-- Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
