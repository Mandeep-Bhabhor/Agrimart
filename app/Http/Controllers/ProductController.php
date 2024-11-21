<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
  
    public function showform()
    {
        return view('admin.products.createproducts');
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

        $path = 'uploads/products/';
        $file->move($path,$filename);
    }

    Product::create([
        'name' => $request->name,
        'price'  => $request->price,
        'stock'  => $request->stock,
        'image'  => $path.$filename
    ]);

    return redirect('/createproducts')->with('status','product created');
  }


  public function adminproduct()
  {
    $products = Product::all();  // Fetch all products
    return view('admin.products.adminproducts', compact('products'));  
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
      if ($request->hasFile('image')) {
          $file = $request->file('image');
          $extension = $file->getClientOriginalExtension();
          $filename = time() . '.' . $extension;
  
          $path = 'uploads/products/';
          $file->move($path, $filename);
  
          // Delete the old image if it exists
          if (File::exists($products->image)) {
              File::delete($products->image);
          }
  
          // Update the image path
          $imagePath = $path . $filename;
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
