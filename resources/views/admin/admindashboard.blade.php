<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Welcome to the Admin Dashboard</h1>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Audit Logs</h5>
                        <p class="card-text">View recent login and logout activities in the audit table.</p>
                        <button id="viewAuditBtn" class="btn btn-primary">View Audit Logs</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Logout</h5>
                        <p class="card-text">You can safely log out of the admin panel here.</p>
                        <a href="/logout" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>

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

                    // Clear table
                    t_data.innerHTML = "";

                    // Populate rows
                    obj.data.forEach(function (item) {
                        t_data.innerHTML += `
                            <tr>
                                <td>${item.auditid}</td>
                                <td>${item.id}</td>
                                <td>${item.usertype}</td>
                                <td>${item.logindate}</td>
                                <td>${item.logintime}</td>
                                <td>${item.logouttime}</td>
                            </tr>`;
                    });

                    // Show the table
                    document.getElementById('auditContainer').style.display = 'block';
                }
            };
        });
    </script>
</body>
</html>
