<x-adminlayout>
    <form action="/addcategory" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container mt-5">
            <h1 class="text-center">Create a Category</h1>

            <!-- Category Name Input -->
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter category name" required />
                <span style="color: red">@error('name'){{$message}}@enderror</span>
            </div>

            <!-- Image Upload Input -->
            <div class="mb-3">
                <label for="image" class="form-label">Category Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required />
                <span style="color: red">@error('image'){{$message}}@enderror</span>
            </div>

            <!-- Submit Button -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Add Category</button>
            </div>
        </div>
    </form>
</x-adminlayout>
