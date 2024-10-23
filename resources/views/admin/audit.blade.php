<!-- resources/views/audit_logs.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Logs</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Include your CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <h1>Audit Logs</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Audit ID</th>
                    <th scope="col">User ID</th>
                    <th scope="col">User type</th>
                    <th scope="col">Login Date</th>
                    <th scope="col">Login Time</th>
                    <th scope="col">Logout Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($audit as $audit)
                    <tr>
                        <td>{{ $audit->auditid }}</td>
                        <td>{{ $audit->id }}</td>
                        <td>{{ $audit->usertype }}</td>
                        <td>{{ $audit->logindate }}</td>
                        <td>{{ $audit->logintime }}</td>
                        <td>{{ $audit->logouttime }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <li class="nav-item">
        <a class="nav-link active" href="/logout">Logout</a>
      </li>
</body>
</html>
