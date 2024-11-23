<x-layout>
   

<div class="container mt-5">
    <h2 class="mb-4">Product List</h2>
    
    @if($products->isEmpty())
        <div class="alert alert-warning" role="alert">
            No products available.
        </div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Category Name</th>
                    <th>Image</th>
                    <th>Add To Cart</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->category->name ?? 'No Category' }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 100px; height: 100px;">
                        @else
                            <span class="text-muted">No image</span>
                        @endif
                    </td>
                    <td>
                    <form action="/order" method="POST">
                        <input type="hidden" name="product_id" value="{{$product->id}}"/>
                         <input type="hidden" name="product_name" value="{{$product->name}}"/>
                        <input type="hidden" name="product_price" value="{{$product->price}}"/>
                       

                        @csrf
                        <button class="btn btn-success">Add to orders</button>
                    </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>


</x-layout>