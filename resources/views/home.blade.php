<x-layout>
    <div class="container mt-5">
        <!-- Hero Section -->
        <div class="bg-success p-5 rounded shadow mb-4 text-center">
            <h1 class="display-4 text-primary">Welcome to Agrimart!</h1>
            <p class="lead">Discover the best agricultural products at unbeatable prices.</p>
            <a href="/products" class="btn btn-light btn-lg mt-3">
                <i class="bi bi-cart-check me-2"></i>Shop Now
            </a>
        </div>

        <!-- Product Section -->
        <h2 class="text-center mb-4">Featured Products</h2>
        @if($products->isEmpty())
            <div class="alert alert-warning text-center" role="alert">
                No products available.
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($products as $product)
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <!-- Product Image -->
                            <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                            <!-- Card Body -->
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text text-muted">{{ $product->category->name ?? 'Uncategorized' }}</p>
                                <p class="card-text">
                                    <strong>${{ number_format($product->price, 2) }}</strong>
                                    <span class="text-muted">Stock: {{ $product->stock }}</span>
                                </p>
                            </div>
                            <!-- Card Footer -->
                            <div class="card-footer text-center bg-light">
                                <form action="/order" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="product_name" value="{{ $product->name }}">
                                    <input type="hidden" name="product_price" value="{{ $product->price }}">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="bi bi-cart-plus me-1"></i>Add to Orders
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

   
</x-layout>
