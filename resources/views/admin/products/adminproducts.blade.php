<x-adminlayout>
   

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
                        <th>Image</th>
                        <th>edit</th>
                        <th>delete</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 100px; height: 100px;">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>
                        <td><a href = "{{url($product->id.'/editproducts')}}" class="btn btn-success mx-2">Edit</a></td>
                        <td><a href = "{{url($product->id.'/deleteproducts')}}" class="btn btn-danger mx-2">Delete</a></td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    
    
    </x-adminlayout>