<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{

   function register()
   {
    return view('register');
   }

   function login()
   {
    return view('login');
   }

   function about()
   {
    return view('about');
   }

   function contact()
   {
    return view('contact');
   }

   function admindash()
   {
    return view('admin.admindashboard');
   }


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
      return redirect('userlogin')->with('success','Congratulations! Your Account created');
    }
    }

    function ulogin(Request $data){
      $user=User::where('email',$data->input('email'))->where('password',$data->input('password'))->first();
      if($user){

             session()->put('id',$user->id);
         //    dd($user);
             session()->put('usertype',$user->usertype);
            
             $loginTime = now()->toTimeString();
            
             DB::table('Audit')->insert([
              'id' => $user->id,
              'usertype'=>$user->usertype,
              'logindate' => now()->toDateString(), // Current date
              'logintime' => $loginTime, // Current login time
              'logouttime' => null  
            
              ]);
      if($user->usertype==='customer')
      {
        return redirect('/about');
      }else{
        return redirect('/admindashboard');
      }
           
      }else{
        return redirect('login')->with('error','Congratulations! Your not varified');
      }
    }

    function ulogout()
    {

      $user = session('id');
      if($user)
      {
      DB::table('Audit')
        ->where('id',$user)
        ->whereNull('logouttime') // Assuming you want to update the last log entry
        ->update(['logouttime' => now()->toTimeString()]); // Update logout time
      
      session()->forget('id');
      session()->forget('usertype');
      return redirect('/about');  
      }

    }
    
   function audit()
    {
        // Retrieve all audit logs from the database
        $audit = DB::table('audit')->get(); // Adjust table name if different
      //  dd($audit);
        // Return a view with the logs data
        return view('admin.audit', ['audit' => $audit]);
    }
    

}
