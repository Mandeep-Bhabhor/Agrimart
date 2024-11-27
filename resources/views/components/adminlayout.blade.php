
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/journal/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Button for View Audit Logs -->
                    <li class="nav-item">
                        <button id="viewAuditBtn" class="btn btn-secondary nav-link me-2">View Audit Logs</button>
                    </li>
                    <li class="nav-item">
                        <a href="/adminproducts" class="btn btn-secondary nav-link">Products</a>
                    </li>
                    <!-- Button for Logout -->
                    <li class="nav-item">
                        <a href="/logout" class="btn btn-secondary nav-link">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a href="/createproducts" class="btn btn-secondary nav-link">Add Product</a>
                    </li>
                    <li class="nav-item">
                        <a href="/admincategory" class="btn btn-secondary nav-link">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a href="/addcategory" class="btn btn-secondary nav-link">Add Category</a>
                    </li>
                    <li class="nav-item">
                        <a href="/history" class="btn btn-secondary nav-link">Order History</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif<div class="mx-auto">
            @if(session('error'))
    <div class="alert alert-danger">
        {{ session('status') }}
    </div>
@endif
        <!-- Audit Logs Table -->
        <div id="auditContainer" class="mt-4" style="display: none;">
            <h2 class="text-center">Audit Logs</h2>
            <table class="table table-striped" id="table_data">
                <thead>
                    <tr>
                        <th scope="col">Audit ID</th>
                        <th scope="col">User ID</th>
                        <th scope="col">User Type</th>
                        <th scope="col">Login Date</th>
                        <th scope="col">Login Time</th>
                        <th scope="col">Logout Time</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('viewAuditBtn').addEventListener('click', function () {
            var t_data = document.querySelector('#table_data tbody');
            var req = new XMLHttpRequest();
    
            req.open("GET", "/sh", true);
            req.send();

            req.onreadystatechange = function () {
                if (req.readyState == 4 && req.status == 200) {
                    var obj = JSON.parse(req.responseText);

                    t_data.innerHTML = "";

                    obj.data.forEach(function (item) {
                        t_data.innerHTML += `
                            <tr>
                                <td>${item.id}</td>
                                <td>${item.user_id}</td>
                                <td>${item.usertype}</td>
                                <td>${item.logindate}</td>
                                <td>${item.logintime}</td>
                                <td>${item.logouttime}</td>
                            </tr>`;
                    });

                    document.getElementById('auditContainer').style.display = 'block';
                }
            };
        });
    </script>
     <!-- Main Section -->
  <main class="d-flex justify-content-center align-items-center">
    <div class="container">
      <!-- Dynamic Content -->
      {{ $slot }}
    </div>
  </main>
</body>
</html>
