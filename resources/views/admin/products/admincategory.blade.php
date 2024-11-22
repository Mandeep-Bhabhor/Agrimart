<x-adminlayout>
   

    <div class="container mt-5">
        <h2 class="mb-4">Category List</h2>
        
        @if($categories->isEmpty())
            <div class="alert alert-warning" role="alert">
                No categories available.
            </div>
        @else
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                       
                        <th>Image</th>
                        <th>edit</th>
                        <th>delete</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                      
                        <td>
                            @if($category->image && file_exists(public_path($category->image)))
                            <img src="{{ asset($category->image) }}" 
                                 alt="{{ $category->name }}" 
                                 class="img-thumbnail" 
                                 style="width: 100px; height: 100px;">
                        @else
                            <span class="text-muted">No image</span>
                        @endif
                        </td>
                        <td><a href = "{{url($category->id.'/editcategory')}}" class="btn btn-success mx-2">Edit</a></td>
                        <td><a href = "{{url($category->id.'/deletecategory')}}" class="btn btn-danger mx-2">Delete</a></td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    
    
    </x-adminlayout>