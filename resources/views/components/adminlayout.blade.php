<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin Dashboard</title>

  <!-- Zephyr Theme CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/zephyr/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

  <style>
    /* General Styling */
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f9f4; /* Light green background */
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    header {
      background-color: #388e3c;
      color: white;
      padding: 1rem 2rem;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar {
      padding: 0;
    }

    .navbar-brand {
      font-size: 1.8rem;
      font-weight: bold;
      color: white;
    }

    .navbar-nav .nav-link {
      color: white;
      font-size: 1rem;
      padding: 0.8rem 1rem;
      transition: background-color 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 5px;
    }

    .navbar-nav .nav-link.active {
      background-color: #66bb6a;
      color: white;
    }

    .navbar-toggler-icon {
      color: white;
    }

    /* Button Styling */
    .btn-custom {
      background-color: #66bb6a;
      color: white;
      padding: 0.6rem 1.2rem;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      transition: transform 0.3s ease, background-color 0.3s ease;
      border: none;
    }

    .btn-custom:hover {
      background-color: #388e3c;
      transform: scale(1.05);
    }

    .btn-light-custom {
      background-color: #aed581;
      color: #8e3838;
      padding: 0.6rem 1.2rem;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      transition: background-color 0.3s ease, transform 0.3s ease;
      border: none;
    }

    .btn-light-custom:hover {
      background-color: #66bb6a;
      transform: scale(1.05);
    }

    /* User Button */
    .user-btn {
      background-color: white;
      color: #388e3c;
      border-radius: 8px;
      padding: 0.6rem 1.2rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-weight: 600;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .user-btn:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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
      padding: 3rem;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      margin: 2rem auto;
      width: 80%;
    }

    .alert {
      margin-bottom: 1rem;
    }

    /* Footer */
    footer {
      background-color: #388e3c;
      color: white;
      padding: 1.5rem;
      text-align: center;
    }

    footer a {
      color: #c8e6c9;
      text-decoration: none;
    }

    footer a:hover {
      text-decoration: underline;
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: #f1f8f4;
    }

    .table-striped tbody tr:nth-of-type(even) {
      background-color: #e4f1e3;
    }

    .text-center {
      text-align: center;
    }

    /* Media Queries for Mobile */
    @media (max-width: 768px) {
      header {
        padding: 1rem;
      }

      .navbar-brand {
        font-size: 1.5rem;
      }

      .navbar-nav .nav-link {
        font-size: 0.9rem;
      }

      main {
        width: 90%;
        padding: 2rem;
      }

      .btn-custom, .btn-light-custom {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
      }

      .user-btn {
        padding: 0.5rem 1rem;
      }
    }

  </style>
</head>
<body>

  <!-- Header -->
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a href="/admindash" class="btn-custom nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="/audit" class="btn-custom nav-link"> View Audit</a>
            </li>
            <li class="nav-item">
              <a href="/adminproducts" class="btn-custom nav-link">Products</a>
            </li>
            <li class="nav-item">
              <a href="/createproducts" class="btn-custom nav-link">Add Product</a>
            </li>
            <li class="nav-item">
              <a href="/admincategory" class="btn-custom nav-link">Categories</a>
            </li>
            <li class="nav-item">
              <a href="/addcategory" class="btn-custom nav-link">Add Category</a>
            </li>
            <li class="nav-item">
              <a href="/history" class="btn-custom nav-link">Order History</a>
            </li>
          </ul>
          <div class="dropdown ms-3">
            @if(Auth::check())
            <a class="btn-dark user-btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="/adminprofile">Profile</a></li>
             
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

  <!-- Main Content -->
  <main>
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Slot for dynamic content -->
    <div class="mt-4">
      {{ $slot }}
    </div>
  </main>

  <!-- Footer -->
  <footer>
    <p>&copy; 2024 Agrimart Admin. All rights reserved.</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



</body>
</html>
