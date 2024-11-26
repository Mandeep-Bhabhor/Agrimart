<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Bus\UpdatedBatchJobCounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\hash;

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


    function adduser(Request $data){
      $newuser=new User();
      $newuser->name=$data->input('username');
      $newuser->email=$data->input('email');
      $newuser->password=$data->input('password');
      $newuser->phone=$data->input('phone');
      $newuser->address=$data->input('address');
     // $data->file('file')->move('./uplods/profiles/');
      $newuser->usertype="customer";
     if($newuser->save())
    {
      return redirect('login')->with('success','Congratulations! Your Account created');
    }
    }


     public function viewprofile()
     {
        if(Auth::check()){
            $user = Auth::user();
            return view('userprofile', data: compact('user'));
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



     public function editprofile(Request $request,int $id)
     {
        if(Auth::check()){
            $user = Auth::user();
          
           

             // Validate inputs
      $request->validate([
        'name' => 'required|min:3|max:255|string',
       
       'email' => 'required|email',

       'password' => 'required|min:3|max:255|string',
    ]);

    $user = User::findorfail($id);
          
     if ($request->has('name') && $request->input('name') != $user->name) {
        $user->name = $request->input('name');
    }
    
    if ($request->has('email') && $request->input('email') != $user->email) {
        $user->email = $request->input('email');
    }

    // Save the updated user
   

   $user->save();
   return redirect('/profile')->with('status', 'your profile is successfully updated.');
}
         
         else{
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
      

    function ulogin(Request $data) {
      // Retrieve the user by email and plain text password
      $user = User::where('email', $data->input('email'))
                  ->where('password', $data->input('password')) // No hashing, direct comparison
                  ->first();
  
      if ($user) {
          // Use Laravel's Auth::login() to log the user in
          Auth::login($user);
        
          $uid = Auth::id();
          // Insert login time into the Audit table
          $loginTime = now()->toTimeString();
          DB::table('Audits')->insert([
              'user_id' => $uid,
              'usertype' => $user->usertype,
              'logindate' => now()->toDateString(),
              'logintime' => $loginTime,
              'logouttime' => null
          ]);
  
          // Redirect based on user type
          if ($user->usertype === 'customer') {
              return redirect('/');
          } else if ($user->usertype === 'admin') {
              return redirect('admindash');
          }
      } else {
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
             
              ->whereNull('logouttime') // Update the last log entry
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
      return view('admin.admindashboard');
  }
  
  function audit() {
      $audit = DB::table('audits')->get(); 
      return view('admin.audit', ['audit' => $audit]);
  }
  

  function sh() {
    $audit = DB::table('audits')->get();
    return response()->json(['data' => $audit]); 
}

}
