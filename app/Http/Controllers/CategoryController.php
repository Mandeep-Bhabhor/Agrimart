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
  
            $path = 'uploads/categories/';
          $file->move($path, $filename);
      }

        // Save the category in the database
        Category::create([
            'name' => $request->name,
            'image' => $path.$filename, // Save relative path
        ]);

        return redirect('/admincategory')->with('status', 'Category created successfully.');
    }

    public function edit(int $id)
    {
      $category = Category::findorfail($id);
      echo($category);
      return view('admin.products.editcategory', data: compact('category'));  
  
    }
     
    public function update(Request $request, int $id)
  {
      // Validate inputs
      $request->validate([
          'name' => 'required|min:3|max:255|string',
         
          'image' => 'nullable|mimes:png,jpg,jpeg,webp' // Image is optional
      ]);
  
      // Find the product or fail
      $category = Category::findOrFail($id);
  
      // Initialize the image path variable
      $imagePath = $category->image; // Default to the current image
  
      // Check if a new image is uploaded
      if ($request->hasFile('image')) {
          $file = $request->file('image');
          $extension = $file->getClientOriginalExtension();
          $filename = time() . '.' . $extension;
  
          $path = 'uploads/categories/';
          $file->move($path, $filename);
  
          // Delete the old image if it exists
          if (File::exists($category->image)) {
              File::delete($category->image);
          }
  
          // Update the image path
          $imagePath = $path . $filename;
      }
  
      // Update the product details
      $category->update([
          'name' => $request->name,
          'image' => $imagePath // Use the updated image path or retain the current one
      ]);
  
      return redirect('admincategory')->with('status', 'category updated successfully!');
  }
  
     public function delete(int $id)
      {
          $category = Category::findOrFail($id);
          $category->delete();
  
          //return redirect()->back()->with('status',value: 'product deleted');
          return redirect()->back()->with('status', 'category deleted');
  
        }
}
