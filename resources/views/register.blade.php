<x-layout>
    <div class="container mt-5">
        <!-- Card Container -->
        <div class="card shadow mx-auto" style="max-width: 500px;">
            <div class="card-header bg-primary text-white text-center">
                <h2>Register</h2>
            </div>
            <div class="card-body">
                <!-- Registration Form -->
                <form action="adduser" method="POST">
                    @csrf

                    <!-- Username Field -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" />
                        <span class="text-danger">@error('username'){{ $message }}@enderror</span>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" />
                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" />
                        <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                    </div>

                    <!-- Phone Number Field -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" placeholder="Enter phone number" name="phone" />
                        <span class="text-danger">@error('phone'){{ $message }}@enderror</span>
                    </div>

                    <!-- Address Field -->
                    <div class="mb-4">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" />
                        <span class="text-danger">@error('address'){{ $message }}@enderror</span>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-person-plus me-2"></i>Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Styling for Form -->
    <style>
        .form-label {
            font-weight: 600;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 4px rgba(13, 110, 253, 0.25);
        }

        .btn-primary {
            background-color: #3108e8;
            border-color: #0d6efd;
        }

        .btn-primary:hover {
            background-color: #084298;
            border-color: #084298;
        }
    </style>
</x-layout>
