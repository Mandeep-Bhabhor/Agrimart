

<x-layout>
    
    <h1>this is user profile</h1>

    <form action="{{url('/editprofile'.'/'.$user->id)}}" method="POST">
        @if(session()->has('success'))
        <div>
            <p>{{ session()->get("success") }}</p>
        </div>
        @endif
        @csrf
        @method('PUT')
        <div class="container mt-5">
            <h1 class="text-center">Update your Profile</h1>
    
        <div class="mb-3">
            <label for="name" class="form-label">User Name</label>
            <input type="name" class="form-control" value="{{$user->name}}"  id="name" placeholder="Enter name" name="name"/>
            <span style="color: red">@error('name'){{$message}}@enderror</span>
        </div>
      
        <div class="mb-3password      <label for="email" class="form-label">User Email</label>
            <input type="email" class="form-control" value="{{$user->email}}" id="email" placeholder="Enter email" name="email"/>
            <span style="color: red">@error('email'){{$message}}@enderror</span>
        <br>
        <div class="mb-3">
            <label for="password" class="form-label">User password</label>
            <input type="password" class="form-control" value="{{$user->password}}" id="password" placeholder="Enter password" name="password"/>
            <span style="color: red">@error('password'){{$message}}@enderror</span>    
            {{-- <button type="submit" class="btn btn-primary" name="submit">Upload</button> --}}

       
    <br>
    
        <div class="d-grid">
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </div>
       
    </form>
        </div>


</x-layout>