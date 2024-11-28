
<x-adminlayout>
        <!-- User Count -->
        <div class="container mt-4">
            <div class="row">
                <div class="col text-center">
                    <h3>Total Users: {{ $userCount }}</h3>
                </div>
            </div>
        </div>
    
        <!-- Admin Dashboard Header -->
        <div class="container mt-5">
            <h1 class="text-center">Welcome to the Admin panel</h1>
           
        </div>
    
        <!-- Users Table -->
        <div class="container mt-4">
            <h3 class="text-center mb-4">Users List</h3>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>User Password</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $users)
                            <tr>
                                <td>{{ $users->name }}</td>
                                <td>{{ $users->email }}</td>
                                <td>{{ $users->password }}</td>
                                <td>{{ $users->address }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </x-adminlayout>
    