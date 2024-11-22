<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Contracts\Service\Attribute\Required;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::all();  // Fetch all products
        return view('products', compact('products'));  // Pass products to the home view
    }
  
    public function adminproduct()
    {
        $products = Product::with('category')->get();
        return view('admin.products.adminproducts', compact('products'));
    }
  
    public function showform()
    {
         $categories = Category::all();
        return view('admin.products.createproducts',compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|max:255|string',
            'price' => 'required|numeric|min:0', // Price should not be negative
            'stock' => 'required|integer|min:0', // Stock should not be negative
            'category' => 'required|exists:categories,id', // Ensure the category exists
            'image' => 'required|mimes:png,jpg,jpeg,webp|max:2048', // Validate image file
        ]);
    
        // Initialize the image path
        $imagePath = null;
    
        // Check if an image is uploaded
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
    
            $path = 'uploads/products/';
            $file->move($path, $filename);
    
            $imagePath = $path . $filename;
        }
    
        // Debugging Step: Verify Request Data
        dd($request->all(), $imagePath);
    
        // Insert product into the database
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'categories_id' => $request->category, // Save category ID
            'image' => $imagePath, // Save uploaded image path
        ]);
    
        // Redirect back with a success message
        return redirect('/createproducts')->with('status', 'Product created successfully');
    }
    
}
