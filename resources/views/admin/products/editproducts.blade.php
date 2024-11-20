<x-adminlayout>
    <div class="mx-auto">
        <form action="{{url('admin/'.$products->id.'/adminproducts')}}" method="POST" enctype="multipart/form-data">
            @if(session()->has('success'))
            <div>
                <p>{{ session()->get("success") }}</p>
            </div>
            @endif
            @csrf
            @method('PUT')
            
            <div class="container mt-5">
                <h1 class="text-center">Update the product</h1>
        
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="name" class="form-control" value="{{$products->name}}" id="name" placeholder="Enter name" name="name"/>
                <span style="color: red">@error('name'){{$message}}@enderror</span>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Product Price</label>
                <input type="number" class="form-control"  value="{{$products->price}}" id="price" placeholder="Enter price" name="price"/>
                <span style="color: red">@error('price'){{$message}}@enderror</span>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Product stock</label>
                <input type="number" class="form-control" value="{{$products->stock}}" id="stock" placeholder="Enter Quantity" name="stock"/>
                <span style="color: red">@error('stock'){{$message}}@enderror</span>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" value="{{$products->image}}" id="image" placeholder="Upload file" name="image"/>
                <span style="color: red">@error('file'){{$message}}@enderror</span>
            
                {{-- <button type="submit" class="btn btn-primary" name="submit">Upload</button> --}}

           
        <br>
        
            <div class="d-grid">
                <button type="submit" class="btn btn-primary" name="submit">Update</button>
            </div>
        </form>
            </div>
    
    
</x-adminlayout>    