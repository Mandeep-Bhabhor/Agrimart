<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Bus\UpdatedBatchJobCounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\hash;
use App\Models\Order;

class UserController extends Controller
{

  

  
   function register()
   {
    return view('register');
   }

   function login()
   {
    if(Auth::check()){
        if(Auth::user()->usertype == 'admin'){
            return redirect('adminproducts');
        }
        return redirect('products');
    }
    else{    
        return view('login');
        }
   }

   function about()
   {
    return view('about');
   }

   function contact()
   {
    return view('contact');
   }

  //  function admindash(Request $data)
  //  {
  //   // if(!Auth::check()){
   
  //   //   return redirect()->route('about');
  //   // }
  //   //   else{
  //   return view('admin.admindashboard');
  //  }




  public function adduser(Request $data)
  {
      // Validate the incoming request data
      $validated = $data->validate([
          'username' => 'required|string|max:255',
          'email'    => 'required|email|unique:users,email',
          'password' => 'required|string|min:8',
          'phone'    => 'required|numeric|digits_between:10,15',
          'address'  => 'required|string|max:500',
      ], [
          // Optional: Custom error messages
          'username.required' => 'Please provide a username.',
          'email.required'    => 'The email address is required.',
          'email.unique'      => 'This email is already registered.',
          'phone.numeric'     => 'The phone number must be numeric.',
          'phone.digits_between' => 'The phone number must be between 10 and 15 digits.',
          'address.required'  => 'Please provide your address.',
      ]);
  
      // Create a new user
      $newuser = new User();
      $newuser->name = $validated['username'];
      $newuser->email = $validated['email'];
      $newuser->password = $validated['password']; // Hash the password
      $newuser->phone = $validated['phone'];
      $newuser->address = $validated['address'];
      $newuser->usertype = "customer";
  
      if ($newuser->save()) {
          return redirect('login')->with('success', 'Congratulations! Your account has been created.');
      }
  
      return redirect()->back()->with('error', 'Failed to create an account. Please try again.');
  }
  


     public function viewprofile()
     {
        if(Auth::check()){
            $user = Auth::user();
            if ($user->usertype === 'customer') {
                return view('userprofile', data: compact('user'));
            }
           else{
            return view('admin.adminprofile', data: compact('user'));
           }
         }
         else{
            return redirect('/login');
                 }

     }



     public function vieweditprofile()
     {
        if(Auth::check()){
            $user = Auth::user();
            
          //  $user = User::findorfail($id);
            return view('updateuser', data: compact('user'));
         }
         else{
            return redirect('/login');
                 } 
     }



     public function editprofile(Request $request, int $id)
     {
         if (Auth::check()) {
             $user = Auth::user();
     
             // Validate inputs
             $request->validate([
                 'name' => 'required|min:3|max:255|string',
                 'email' => 'required|email',
                 'password' => 'required|min:3|max:255|string',
             ]);
     
             // Find the user by ID
             $user = User::findOrFail($id);
     
             // Check if the name or email needs to be updated
             if ($request->has('name') && $request->input('name') != $user->name) {
                 $oldName = $user->name; // Store the old username
                 $user->name = $request->input('name');
             }
     
             if ($request->has('email') && $request->input('email') != $user->email) {
                 $user->email = $request->input('email');
             }
     
             // Save the updated user
             $user->save();
     
             // Update the username in the orders table if it has changed
             if (isset($oldName)) {
                 Order::where('user_name', $oldName)
                     ->update(['user_name' => $user->name]);
             }
     
             return redirect('/profile')->with('status', 'Your profile has been successfully updated.');
         } else {
             return redirect('/login');
         }
     }
     
     public function deleteprofile(int $id)
     {
        $user = User::findOrFail($id);
        $user->delete();

        //return redirect()->back()->with('status',value: 'product deleted');
        return redirect('/')->with('status', 'User deleted');
     }
      

   
     public function ulogin(Request $data)
     {
         // Validate the input
         $data->validate([
             'email'    => 'required|email',
             'password' => 'required|string|min:8',
         ], [
             'email.required'    => 'The email field is required.',
             'email.email'       => 'Please provide a valid email address.',
             'password.required' => 'The password field is required.',
             'password.min'      => 'The password must be at least 8 characters.',
         ]);
     
         // Attempt to retrieve the user with plain-text password (insecure, but matches your scenario)
         $user = User::where('email', $data->input('email'))
                     ->where('password', $data->input('password')) // Direct comparison (not hashed)
                     ->first();
     
         if ($user) {
             // Log the user in using Laravel's Auth facade
             Auth::login($user);
     
             $uid = Auth::id();
     
             // Insert login details into the Audit table
             DB::table('Audits')->insert([
                 'user_id'    => $uid,
                 'usertype'   => $user->usertype,
                 'logindate'  => now()->toDateString(),
                 'logintime'  => now()->toTimeString(),
                 'logouttime' => null
             ]);
     
             // Redirect based on user type
             if ($user->usertype === 'customer') {
                 return redirect('/');
             } else if ($user->usertype === 'admin') {
                 return redirect('admindash');
             }
         } else {
             // Redirect back with an error message
             return redirect('login')->with('error', 'The provided credentials are incorrect.');
         }
     }
     

  function ulogout()
  {
      // Check if the user is logged in
      if (Auth::check()) {
          $user = Auth::user(); // Get the authenticated user
          
          // Update logout time in the Audit table
          DB::table('Audits')
          ->where('user_id', Auth::id()) // Check for the authenticated user's ID
          ->whereNull('logouttime')      // Update only the last log entry with null logout time
          ->update(['logouttime' => now()->toTimeString()]);
      
  
          // Log out the user and clear session
          Auth::logout(); // Laravel's built-in logout method
  
          session()->flush();  // Clear all session data
          
          return redirect('/login');  // Redirect after logout
      }
  
      // If the user is not logged in, just redirect
      return redirect('/login');
  }
    
  //  function audit()
  //   {
  //       // Retrieve all audit logs from the database
  //       $audit = DB::table('audit')->get(); // Adjust table name if different
  //     //  dd($audit);
  //       // Return a view with the logs data
  //       return view('admin.audit', ['audit' => $audit]);
  //   }
    

    function admindash() {
        $user = User::where('usertype','customer')->get();
        $userCount = $user->count(); 
      return view('admin.admindashboard',compact('user','userCount'));
  }
  
  function audit() {
      $audit = DB::table('audits')->get(); 
      $user = User::all();
      return view('admin.audit', ['audit' => $audit],compact('user'));
  }
  

  function sh() {
    $audit = DB::table('audits')->get();
    return response()->json(['data' => $audit]); 
}

}
