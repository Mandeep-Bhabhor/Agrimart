<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Fetch all products
        return view('products', compact('products')); // Pass products to the home view
    }
  
    public function adminproduct()
    {
        $products = Product::with('category')->get(); // Fetch products with their categories
        return view('admin.products.adminproducts', compact('products'));
    }
  
    public function showform()
    {
        $categories = Category::all(); // Fetch all categories for dropdown
        return view('admin.products.createproducts', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|max:255|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categories_id' => 'required|exists:categories,id', // Validate category ID exists
            'image' => 'nullable|mimes:png,jpg,jpeg,webp', // Validate image file
        ]);
        
        // Initialize the image path
        if($request->has('image')){

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
    
            $filename = time().'.'.$extension;
    
            $path = 'uploads/products/';
            $file->move($path,$filename);
        }
        // Insert product into the database
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $path,$filename, // Save the image path
            'categories_id' => $request->categories_id,
        ]);

        // Redirect back with a success message
        return redirect('/adminproducts')->with('status', 'Product created successfully');
    }


  
    public function edit(int $id)
    {
      $products = Product::findorfail($id);
      echo($products);
      return view('admin.products.editproducts', data: compact('products'));  
  
    }
     
    public function update(Request $request, int $id)
    {
        // Validate inputs
        $request->validate([
            'name' => 'required|min:3|max:255|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp' // Image is optional
        ]);
    
        // Find the product or fail
        $products = Product::findOrFail($id);
    
        // Initialize the image path variable
        $imagePath = $products->image; // Default to the current image
    
        // Check if a new image is uploaded
     
    if($request->has('image')){

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        $filename = time().'.'.$extension;

        $path = 'uploads/products/';
        $file->move($path,$filename);
    }
    
        // Update the product details
        $products->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath // Use the updated image path or retain the current one
        ]);
    
        return redirect('adminproducts')->with('status', 'Product updated successfully!');
    }
    
  
     public function delete(int $id)
      {
          $products = Product::findOrFail($id);
          $products->delete();
  
          //return redirect()->back()->with('status',value: 'product deleted');
          return redirect()->back()->with('status', 'Product deleted');
  
        }
}
