<x-layout>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0 text-center">Product List</h2>
            </div>
            <div class="card-body">
                @if($products->isEmpty())
                    <div class="alert alert-warning text-center" role="alert">
                        No products available.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Add to Cart</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td class="text-center">{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td class="text-center">${{ number_format($product->price, 2) }}</td>
                                        <td class="text-center">{{ $product->stock }}</td>
                                        <td>{{ $product->category->name ?? 'No Category' }}</td>
                                        <td class="text-center">
                                            @if($product->image)
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 100px; height: 100px;">
                                            @else
                                                <span class="text-muted">No image</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <form action="/order" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="product_name" value="{{ $product->name }}">
                                                <input type="hidden" name="product_price" value="{{ $product->price }}">
                                                <button class="btn btn-success btn-sm">
                                                    <i class="bi bi-cart-plus me-1"></i>Add to Orders
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
