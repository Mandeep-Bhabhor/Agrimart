<x-adminlayout>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 text-center">Admin Profile</h4>
            </div>
            <div class="card-body">
                <form id="user-profile-form">
                    <!-- Username -->
                    <div class="mb-3">
                        <label for="admin-name" class="form-label">Admin Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" readonly>
                    </div>
    
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="user-email" class="form-label">Admin Email</label>
                        <input type="email" class="form-control" id="user-email" name="email" value="{{ $user->email }}" readonly>
                    </div>
    
                    <!-- Password -->
                    <div class="mb-3">
                        <label for="user-password" class="form-label">Admin Password</label>
                        <input type="password" class="form-control" id="user-password" value="**********" readonly>
                    </div>
    
                    <!-- Buttons -->
                    <div class="d-flex justify-content-between">
                        <!-- Edit Button -->
                        <a href="{{ url('/editprofile', $user->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square me-2"></i>Edit Profile
                        </a>
    
                    
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-adminlayout>