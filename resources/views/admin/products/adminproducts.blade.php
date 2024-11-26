<x-adminlayout>
    <div class="container mt-5">
        <h2 class="mb-4">Product List</h2>
        
        @if($products->isEmpty())
            <div class="alert alert-warning" role="alert">
                No products available.
            </div>
        @else
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ $product->image && file_exists(public_path($product->image)) ? asset($product->image) : '' }}" 
                                 alt="{{ $product->name }}" 
                                 class="card-img-top" 
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">Price: ${{ number_format($product->price, 2) }}</p>
                                <p class="card-text">Stock: {{ $product->stock }}</p>
                                <p class="card-text">Category: {{ $product->category->name ?? 'No Category' }}</p>
                                <a href="{{ url($product->id . '/editproducts') }}" class="btn btn-sm btn-success">Edit</a>
                                <a href="{{ url($product->id . '/deleteproducts') }}" class="btn btn-sm btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-adminlayout>
