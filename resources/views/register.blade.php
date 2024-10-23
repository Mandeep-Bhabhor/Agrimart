
<x-layout>
    <div class="mx-auto">
<form action="adduser" method="POST">
    @csrf
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" placeholder="Enter username" name="username"/>
     

        <span style="color: red">@error('username'){{$message}}@enderror</span>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">email</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"/>
        <span style="color: red">@error('email'){{$message}}@enderror</span>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password"/>
        <span style="color: red">@error('password'){{$message}}@enderror</span>
    <div class="mb-3">
        <label for="phone number" class="form-label">phone number</label>
        <input type="text" class="form-control" id="phone" placeholder="Enter phonenumber" name="phone"/>
        <span style="color: red">@error('phone'){{$message}}@enderror</span>
    </div>

    <div class="mb-5">
        <label for="address" class="form-label">address</label>
        <input type="address" class="form-control" id="address" placeholder="Enter address" name="address"/>
        <span style="color: red">@error('address'){{$message}}@enderror</span>
    </div>


    <div class="d-grid">
        <button type="submit" class="btn btn-primary" name="submit">Register</button>
    </div>
</form>
    </div>
</x-layout>