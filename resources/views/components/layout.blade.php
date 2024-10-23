<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Bootstrap Home Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Header Section -->
  <header class="bg-primary text-white py-3">
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Agrimart</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="/about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="/register">Register</a>
            </li>
            @if(session()->has('id'))
            <li class="nav-item">
              <a class="nav-link active" href="/logout">Logout</a>
            </li>
            @else
            <li class="nav-item">
              <a class="nav-link active" href="/login">Login</a>
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link active" href="/contact">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
   
  </header>

  <!-- Optional Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  {{$slot}}
</body>
</html>
