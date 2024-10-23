
<x-layout>
    <div class="mx-auto">
<form action="ulogin" method="POST">
    @if(session()->has('success'))
    <div>
        <p>{{ session()->get("success") }}</p>
    </div>
    @endif
    @csrf
   

    <div class="mb-3">
        <label for="email" class="form-label">email</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"/>
        <span style="color: red">@error('email'){{$message}}@enderror</span>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password"/>
        <span style="color: red">@error('password'){{$message}}@enderror</span>
    

   


    <div class="d-grid">
        <button type="submit" class="btn btn-primary" name="submit">Login</button>
    </div>
</form>
    </div>
</x-layout>