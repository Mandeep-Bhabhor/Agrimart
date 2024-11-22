<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function viewcat()
    {
        $categories = Category::all();
        return view('admin.products.admincategory', compact('categories'));
    }

    public function showform()
    {
        $categories = Category::all();
        return view('admin.products.addcategory', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'image' => 'required|mimes:png,jpg,jpeg,webp', // Validate image file
        ]);
        if($request->has('image')){

          $file = $request->file('image');
          $extension = $file->getClientOriginalExtension();
  
          $filename = time().'.'.$extension;
  
          $path = 'storage/categories/';
          $file->move($path,$filename);
      }

        // Save the category in the database
        Category::create([
            'name' => $request->name,
            'image' => $path,$filename, // Save relative path
        ]);

        return redirect('/admincategory')->with('status', 'Category created successfully.');
    }
}
