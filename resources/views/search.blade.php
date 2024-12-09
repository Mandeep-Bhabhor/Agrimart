<x-layout>
    <main class="container my-4">
        <h1 class="mb-4">Search Results</h1>

        @if($products->isEmpty())
            <div class="alert alert-warning">
                No products found for your search query: <strong>{{ $query }}</strong>.
            </div>
        @else
            <p class="mb-3">Showing results for: <strong>{{ $query }}</strong></p>

            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{  asset($product->image) }}" alt="{{ $product->name  }}" />
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="text-success"><strong>Price:</strong> ${{ $product->price }}</p>
                                {{-- <a href="/products/{{ $product->id }}" class="btn btn-primary btn-sm">View Product</a> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>
</x-layout>
