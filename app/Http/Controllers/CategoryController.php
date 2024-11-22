<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
     public function viewcat(){
        $categories = Category::all();
        return view('admin.products.admincategory', compact('categories'));
     }
    

     public function showform()
     {
      $categories = Category::all();
         return view('admin.products.addcategory');
     }
     
     
      public function store(Request $request)
     {
       $request->validate([
        'name' => 'Required|max:255|string',
        'image' => 'required|mimes:png,jpg,jpeg,webp'
          ]);

          if($request->has('image')){

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
    
            $filename = time().'.'.$extension;
    
            $path = 'uploads/categories/';
            $file->move($path,$filename);
        }
    
        Category::create([
            'name' => $request->name,
            'stock'  => $request->stock,
            'image'  => $path.$filename
        ]);
    
        return redirect('/createproducts')->with('status','category created');
      }
    
     
}
