<x-adminlayout>
    <div class="container mt-5">
        <h2 class="mb-4">Category List</h2>
        
        @if($categories->isEmpty())
            <div class="alert alert-warning" role="alert">
                No categories available.
            </div>
        @else
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <!-- Category Image -->
                            <div class="card-header text-center">
                                @if($category->image && file_exists(public_path($category->image)))
                                    <img src="{{ asset($category->image) }}" 
                                         alt="{{ $category->name }}" 
                                         class="img-fluid" 
                                         style="height: 200px; object-fit: cover;">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </div>
                            
                            <!-- Category Name and Buttons -->
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $category->name }}</h5>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ url($category->id . '/editcategory') }}" class="btn btn-success btn-sm">Edit</a>
                                    <a href="{{ url($category->id . '/deletecategory') }}" class="btn btn-danger btn-sm">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-adminlayout>
