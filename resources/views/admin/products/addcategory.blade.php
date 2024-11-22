<x-adminlayout>
    
  

    <form action="/addcategory" method="POST" enctype="multipart/form-data">
       
        @csrf
        <div class="container mt-5">
            <h1 class="text-center">Create the Category</h1>
    
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="name" class="form-control" value="{{old('name')}}"  id="name" placeholder="Enter name" name="name"/>
            <span style="color: red">@error('name'){{$message}}@enderror</span>
        </div>
      
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" value="{{old('image')}}" id="image" placeholder="Upload file" name="image"/>
            <span style="color: red">@error('file'){{$message}}@enderror</span>
        
            {{-- <button type="submit" class="btn btn-primary" name="submit">Upload</button> --}}

       
    <br>
    
        <div class="d-grid">
            <button type="submit" class="btn btn-primary" name="submit">Add</button>
        </div>
    </form>
        </div>


</x-adminlayout>