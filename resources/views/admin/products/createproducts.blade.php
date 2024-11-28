<x-adminlayout>
    <div class="container mt-5">
        <div class="card border-primary">
            <!-- Card Header -->
            <div class="card-header bg-success text-white text-center">
                <h4>Create Product</h4>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <form action="/createproducts" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Product Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" value="{{ old('name') }}" id="name" placeholder="Enter name" name="name" />
                        <span style="color: red">@error('name'){{ $message }}@enderror</span>
                    </div>

                    <!-- Product Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Product Price</label>
                        <input type="number" class="form-control" value="{{ old('price') }}" id="price" placeholder="Enter price" name="price" />
                        <span style="color: red">@error('price'){{ $message }}@enderror</span>
                    </div>

                    <!-- Product Stock -->
                    <div class="mb-3">
                        <label for="stock" class="form-label">Product Stock</label>
                        <input type="number" class="form-control" value="{{ old('stock') }}" id="stock" placeholder="Enter quantity" name="stock" />
                        <span style="color: red">@error('stock'){{ $message }}@enderror</span>
                    </div>

                    <!-- Product Category -->
                    <div class="mb-3">
                        <label for="category" class="form-label">Product Category</label>
                        <select class="form-control" id="category" name="categories_id">
                            <option value="" disabled selected>Choose a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('categories_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        
                        <span style="color: red">@error('categories_id'){{ $message }}@enderror</span>
                    </div>

                    <!-- Product Image -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="image" name="image" />

                        <span style="color: red">@error('image'){{ $message }}@enderror</span>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-outline-warning">Create Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-adminlayout>
